(function () {
  const menu = document.getElementById('menu');
  const side = document.getElementById('side');
  if (menu && side) {
    menu.addEventListener('click', () => document.body.classList.toggle('nav-open'));
    side.querySelectorAll('a').forEach((link) => {
      link.addEventListener('click', () => document.body.classList.remove('nav-open'));
    });
  }

  document.querySelectorAll('button[form^="restore-"]').forEach((button) => {
    button.addEventListener('click', (event) => {
      if (!window.confirm('Restore this section to the original content?')) event.preventDefault();
    });
  });

  document.querySelectorAll('button[data-confirm]').forEach((button) => {
    button.addEventListener('click', (event) => {
      if (!window.confirm(button.getAttribute('data-confirm'))) event.preventDefault();
    });
  });

  document.querySelectorAll('.block-head').forEach((head) => {
    head.addEventListener('click', (event) => {
      if (event.target.closest('button, a, input, textarea, select')) return;
      head.closest('.block').classList.toggle('is-open');
    });
  });

  document.addEventListener('click', (event) => {
    const add = event.target.closest('[data-add]');
    const remove = event.target.closest('[data-remove]');
    const up = event.target.closest('[data-up]');
    const down = event.target.closest('[data-down]');

    if (add) {
      const repeater = add.closest('[data-repeater]');
      const template = repeater.querySelector(':scope > template');
      const token = template.dataset.token || '__ROW__';
      const html = template.innerHTML.replaceAll(token, 'n' + Date.now());
      const wrap = document.createElement('div');
      wrap.innerHTML = html.trim();
      const row = wrap.firstElementChild;
      repeater.querySelector(':scope > .rep-rows').appendChild(row);
      row.querySelector('input, textarea, select')?.focus();
    }

    if (remove) {
      remove.closest('[data-row]').remove();
    }

    if (up || down) {
      const row = (up || down).closest('[data-row]');
      const rows = row.parentElement;
      if (up && row.previousElementSibling) rows.insertBefore(row, row.previousElementSibling);
      if (down && row.nextElementSibling) rows.insertBefore(row.nextElementSibling, row);
    }
  });
})();
