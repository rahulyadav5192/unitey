<?php

namespace App\Http\Controllers\Admin;

use App\Cms\Catalog;
use App\Http\Controllers\Controller;
use App\Models\CmsBlock;
use App\Models\Inquiry;
use App\Models\Subscriber;
use App\Services\CmsStore;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\View\View;

class ContentController extends Controller
{
    public function __construct(private CmsStore $cms) {}

    public function home(): View
    {
        return view('admin.home', [
            'pages' => Catalog::publicPages(),
            'messages' => Inquiry::query()->count(),
            'subscribers' => Subscriber::query()->count(),
        ]);
    }

    public function edit(string $page): View
    {
        $definition = Catalog::page($page);

        return view('admin.edit', [
            'page' => $definition,
            'content' => $this->cms->page($page),
        ]);
    }

    public function update(Request $request, string $page): RedirectResponse
    {
        $definition = Catalog::page($page);

        foreach ($definition['sections'] as $section) {
            $data = $this->readNode(
                $request,
                $section['fields'],
                $section['groups'],
                's.'.$section['key'],
                'f.'.$section['key'],
                'r.'.$section['key'],
            );

            CmsBlock::query()->updateOrCreate(
                ['page' => $page, 'section' => $section['key']],
                ['data' => $data],
            );
        }

        return redirect()
            ->route('admin.edit', $page)
            ->with('status', 'Saved. The live page is updated.');
    }

    public function restore(string $page, string $section): RedirectResponse
    {
        CmsBlock::query()->updateOrCreate(
            ['page' => $page, 'section' => $section],
            ['data' => Catalog::defaults($page, $section)],
        );

        return redirect()
            ->route('admin.edit', $page)
            ->with('status', 'That section is back to the original content.');
    }

    public function messages(): View
    {
        return view('admin.messages', [
            'messages' => Inquiry::query()->latest()->get(),
        ]);
    }

    public function subscribers(): View
    {
        return view('admin.subscribers', [
            'subscribers' => Subscriber::query()->latest()->get(),
        ]);
    }

    public function destroyMessage(Inquiry $inquiry): RedirectResponse
    {
        $inquiry->delete();

        return redirect()->route('admin.messages')->with('status', 'Message deleted.');
    }

    public function destroySubscriber(Subscriber $subscriber): RedirectResponse
    {
        $subscriber->delete();

        return redirect()->route('admin.subscribers')->with('status', 'Subscriber deleted.');
    }

    public function exportMessages(): StreamedResponse
    {
        return $this->csv('unitey-messages.csv', ['Date', 'From', 'Name', 'Email', 'Phone', 'Business', 'Country', 'Inquiry', 'Message'], Inquiry::query()->latest()->get(), function (Inquiry $message) {
            return [
                $message->created_at->timezone(config('app.timezone'))->format('Y-m-d H:i'),
                ucfirst($message->source),
                $message->name,
                $message->email,
                $message->phone,
                $message->business,
                $message->country,
                $message->inquiry,
                $message->message,
            ];
        });
    }

    public function exportSubscribers(): StreamedResponse
    {
        return $this->csv('unitey-subscribers.csv', ['Date', 'Email', 'Signed up from'], Subscriber::query()->latest()->get(), function (Subscriber $subscriber) {
            return [
                $subscriber->created_at->timezone(config('app.timezone'))->format('Y-m-d H:i'),
                $subscriber->email,
                ucfirst($subscriber->source),
            ];
        });
    }

    /**
     * @param  array<int, string>  $headings
     * @param  iterable<int, mixed>  $rows
     */
    private function csv(string $filename, array $headings, iterable $rows, callable $map): StreamedResponse
    {
        return response()->streamDownload(function () use ($headings, $rows, $map) {
            $out = fopen('php://output', 'w');
            fputcsv($out, $headings);
            foreach ($rows as $row) {
                fputcsv($out, $map($row));
            }
            fclose($out);
        }, $filename, ['Content-Type' => 'text/csv']);
    }

    /**
     * @param  array<int, array<string, mixed>>  $fields
     * @param  array<int, array<string, mixed>>  $groups
     * @return array<string, mixed>
     */
    private function readNode(Request $request, array $fields, array $groups, string $input, string $file, string $remove): array
    {
        $data = [];

        foreach ($fields as $field) {
            if ($field['type'] === 'note') {
                continue;
            }

            $data[$field['key']] = $this->readField(
                $request,
                $field,
                $input.'.'.$field['key'],
                $file.'.'.$field['key'],
                $remove.'.'.$field['key'],
            );
        }

        foreach ($groups as $group) {
            $rows = $request->input($input.'.'.$group['key'], []);
            $items = [];

            if (is_array($rows)) {
                foreach (array_keys($rows) as $index) {
                    $item = $this->readNode(
                        $request,
                        $group['fields'],
                        $group['groups'] ?? [],
                        $input.'.'.$group['key'].'.'.$index,
                        $file.'.'.$group['key'].'.'.$index,
                        $remove.'.'.$group['key'].'.'.$index,
                    );

                    if (! $this->blank($item)) {
                        $items[] = $item;
                    }
                }
            }

            $data[$group['key']] = $items;
        }

        return $data;
    }

    /**
     * @param  array<string, mixed>  $field
     */
    private function readField(Request $request, array $field, string $input, string $file, string $remove): mixed
    {
        if ($field['type'] === 'check') {
            return $request->boolean($input);
        }

        if (in_array($field['type'], ['image', 'video'], true)) {
            if ($request->boolean($remove)) {
                $upload = $request->file($file);
                if (! $upload instanceof UploadedFile) {
                    return '';
                }
            }

            $upload = $request->file($file);
            if ($upload instanceof UploadedFile && $upload->isValid()) {
                return $this->storeUpload($upload);
            }

            return (string) $request->input($input, '');
        }

        $value = (string) $request->input($input, '');

        if ($field['type'] === 'html') {
            return strip_tags($value, '<h2><h3><h4><p><br><em><strong><b><i><a><ul><ol><li><span><blockquote><hr>');
        }

        return $value;
    }

    private function storeUpload(UploadedFile $file): string
    {
        $ext = strtolower($file->getClientOriginalExtension() ?: 'bin');
        $allowed = ['jpg', 'jpeg', 'png', 'webp', 'svg', 'gif', 'jfif', 'mp4', 'webm'];

        if (! in_array($ext, $allowed, true)) {
            return '';
        }

        $dir = public_path('uploads/cms');
        if (! is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $name = now()->format('YmdHis').'-'.bin2hex(random_bytes(4)).'.'.$ext;
        $file->move($dir, $name);

        return 'uploads/cms/'.$name;
    }

    /**
     * @param  array<string, mixed>  $data
     */
    private function blank(array $data): bool
    {
        foreach ($data as $value) {
            if (is_array($value)) {
                foreach ($value as $row) {
                    if (is_array($row) && ! $this->blank($row)) {
                        return false;
                    }
                }

                continue;
            }

            if (is_bool($value)) {
                if ($value) {
                    return false;
                }

                continue;
            }

            if (trim((string) $value) !== '') {
                return false;
            }
        }

        return true;
    }
}
