(function () {
  'use strict';

  var grid = document.getElementById('dsw-grid');
  var modal = document.getElementById('dsw-modal');
  if (!grid || !modal) return;

  var CONTACT = (window.DSW && DSW.contact) || '/contact/';
  var body = document.getElementById('dsw-body');
  var closeBtn = document.getElementById('dsw-close');
  var cards = Array.prototype.slice.call(grid.querySelectorAll('.dsw-card'));
  var buttons = Array.prototype.slice.call(document.querySelectorAll('#dsw-filters button'));
  var lastFocus = null;

  function esc(s) {
    return String(s).replace(/[&<>"]/g, function (c) {
      return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;' }[c];
    });
  }

  /* If an image ever fails, hide it and keep the beige placeholder */
  document.addEventListener('error', function (e) {
    var t = e.target;
    if (t && t.tagName === 'IMG' && (t.closest('.dsw') || t.closest('.dsw-modal'))) {
      t.style.visibility = 'hidden';
    }
  }, true);

  /* Filters */
  document.getElementById('dsw-filters').addEventListener('click', function (e) {
    var b = e.target.closest('button');
    if (!b) return;
    buttons.forEach(function (x) { x.classList.toggle('on', x === b); });
    var f = b.getAttribute('data-f');
    cards.forEach(function (c) {
      c.hidden = !(f === 'all' || c.getAttribute('data-cat') === f);
    });
  });

  /* Case study modal: content is read from the card's own markup */
  function openModal(card) {
    var d = card.querySelector('.dsw-detail');
    var img = card.querySelector('.dsw-media img');
    var name = card.querySelector('h3').textContent;
    var chip = card.querySelector('.dsw-chip').textContent;
    var url = card.querySelector('.dsw-ov a').href;
    var res = d.querySelector('ul');
    var stack = d.querySelector('.dsw-stack');
    var sep = CONTACT.indexOf('?') > -1 ? '&' : '?';
    var q = new URLSearchParams({ service: chip, reference: name }).toString();

    var results = '';
    if (res) {
      results = '<div class="dsw-box"><h5>Key Results</h5><ul>' +
        Array.prototype.map.call(res.children, function (li) {
          return '<li><i class="fa-solid fa-check"></i>' + esc(li.textContent) + '</li>';
        }).join('') + '</ul></div>';
    }
    var tech = stack ? '<div class="dsw-box"><h5>Tech Stack Used</h5>' + stack.outerHTML + '</div>' : '';

    lastFocus = document.activeElement;
    body.innerHTML =
      '<span class="dsw-chip">' + esc(chip) + '</span>' +
      '<h3 id="m-title">' + esc(name) + '</h3>' +
      d.querySelector('.dsw-sub').outerHTML +
      '<img class="dsw-mimg" src="' + esc(img.currentSrc || img.src) + '" alt="' + esc(name) + ' website">' +
      '<h5>Project Details</h5>' + d.querySelector('.ov').outerHTML +
      ((results || tech) ? '<div class="dsw-two">' + results + tech + '</div>' : '') +
      '<div class="dsw-actions">' +
        '<a class="o" href="' + esc(url) + '" target="_blank" rel="noopener noreferrer"><i class="fa-solid fa-globe"></i> Visit Live Site</a>' +
        '<a class="p" href="' + esc(CONTACT + sep + q) + '">Inquire About Similar Build</a>' +
      '</div>';

    modal.classList.add('open');
    modal.setAttribute('aria-hidden', 'false');
    document.body.classList.add('dsw-lock');
    closeBtn.focus();
  }

  function closeModal() {
    modal.classList.remove('open');
    modal.setAttribute('aria-hidden', 'true');
    document.body.classList.remove('dsw-lock');
    if (lastFocus) lastFocus.focus();
  }

  grid.addEventListener('click', function (e) {
    var b = e.target.closest('[data-open]');
    if (b) openModal(b.closest('.dsw-card'));
  });
  closeBtn.addEventListener('click', closeModal);
  modal.addEventListener('click', function (e) { if (e.target === modal) closeModal(); });
  document.addEventListener('keydown', function (e) { if (e.key === 'Escape') closeModal(); });
})();
