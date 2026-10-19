(function () {
	var btn = document.querySelector('.nav-toggle'), nav = document.getElementById('primary-nav');
	if (btn && nav) btn.addEventListener('click', function () {
		var open = nav.classList.toggle('open');
		btn.setAttribute('aria-expanded', open);
		btn.setAttribute('aria-label', open ? 'Đóng menu' : 'Mở menu');
	});
	if (btn && nav) nav.addEventListener('click', function (event) {
		if (event.target.closest('a') && nav.classList.contains('open')) {
			nav.classList.remove('open');
			btn.setAttribute('aria-expanded', 'false');
			btn.setAttribute('aria-label', 'Mở menu');
		}
	});
	document.addEventListener('keydown', function (event) {
		if (event.key === 'Escape' && btn && nav && nav.classList.contains('open')) {
			nav.classList.remove('open');
			btn.setAttribute('aria-expanded', 'false');
			btn.focus();
		}
	});

	var header = document.querySelector('.site-header');
	var onScroll = function () { header && header.classList.toggle('scrolled', window.scrollY > 40); };
	var top = document.querySelector('.to-top');
	var onScroll2 = function () { top && top.classList.toggle('show', window.scrollY > 600); };
	window.addEventListener('scroll', onScroll2, { passive: true }); onScroll2();
	window.addEventListener('scroll', onScroll, { passive: true }); onScroll();

	var cd = document.querySelector('.countdown');
	if (cd) {
		var start = new Date(cd.dataset.start).getTime();
		var el = function (u) { return cd.querySelector('[data-u=' + u + ']'); };
		var pad = function (n) { return String(n).padStart(2, '0'); };
		var timer;
		var tick = function () {
			var t = Math.max(0, start - Date.now());
			el('d').textContent = pad(Math.floor(t / 864e5));
			el('h').textContent = pad(Math.floor(t % 864e5 / 36e5));
			el('m').textContent = pad(Math.floor(t % 36e5 / 6e4));
			el('s').textContent = pad(Math.floor(t % 6e4 / 1e3));
			if (t === 0 && timer) clearInterval(timer);
		};
		tick(); timer = setInterval(tick, 1000);
	}
})();
