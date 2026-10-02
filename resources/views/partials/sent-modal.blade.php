@if (session('sent') === $kind)
  <div class="unitey-modal" role="dialog" aria-modal="true" aria-labelledby="sent-title">
    <div class="unitey-modal-card">
      <p class="eyebrow">{{ $eyebrow }}</p>
      <h2 id="sent-title">{{ $title }}</h2>
      <p>{{ $text }}</p>
      <button type="button" class="btn btn-orange" data-close-modal>Close</button>
    </div>
  </div>
  <script>
    document.querySelectorAll('.unitey-modal').forEach((modal) => {
      const close = () => modal.remove();
      modal.querySelector('[data-close-modal]')?.addEventListener('click', close);
      modal.addEventListener('click', (event) => {
        if (event.target === modal) close();
      });
      document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') close();
      });
      modal.querySelector('[data-close-modal]')?.focus();
    });
  </script>
@endif
