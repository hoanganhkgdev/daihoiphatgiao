(function () {
	var btn = document.querySelector('.nav-toggle'), nav = document.getElementById('primary-nav');
	var searchBtn = document.querySelector('.mobile-search-toggle'), search = document.getElementById('header-search'), searchField = document.getElementById('header-search-field');
	var closeMenu = function (focusToggle) {
		if (!btn || !nav || !nav.classList.contains('open')) return;
		nav.classList.remove('open');
		btn.setAttribute('aria-expanded', 'false');
		btn.setAttribute('aria-label', 'Mở menu');
		if (focusToggle) btn.focus();
	};
	var closeSearch = function (focusToggle) {
		if (!searchBtn || !search || !search.classList.contains('is-open')) return;
		search.classList.remove('is-open');
		searchBtn.setAttribute('aria-expanded', 'false');
		searchBtn.setAttribute('aria-label', 'Mở tìm kiếm');
		if (focusToggle) searchBtn.focus();
	};
	if (btn && nav) btn.addEventListener('click', function () {
		closeSearch(false);
		var open = nav.classList.toggle('open');
		btn.setAttribute('aria-expanded', open);
		btn.setAttribute('aria-label', open ? 'Đóng menu' : 'Mở menu');
	});
	if (searchBtn && search) searchBtn.addEventListener('click', function () {
		closeMenu(false);
		var open = search.classList.toggle('is-open');
		searchBtn.setAttribute('aria-expanded', open);
		searchBtn.setAttribute('aria-label', open ? 'Đóng tìm kiếm' : 'Mở tìm kiếm');
		if (open && searchField) window.setTimeout(function () { searchField.focus(); }, 0);
	});
	if (btn && nav) nav.addEventListener('click', function (event) {
		if (event.target.closest('a') && nav.classList.contains('open')) {
			closeMenu(false);
		}
	});
	document.addEventListener('click', function (event) {
		if (btn && nav && nav.classList.contains('open') && !nav.contains(event.target) && !btn.contains(event.target)) closeMenu(false);
		if (searchBtn && search && search.classList.contains('is-open') && !search.contains(event.target) && !searchBtn.contains(event.target)) closeSearch(false);
	});
	document.addEventListener('keydown', function (event) {
		if (event.key === 'Escape') {
			if (btn && nav && nav.classList.contains('open')) closeMenu(true);
			else if (searchBtn && search && search.classList.contains('is-open')) closeSearch(true);
		}
	});
	window.addEventListener('resize', function () {
		if (window.innerWidth > 1020) closeMenu(false);
		if (window.innerWidth > 560) closeSearch(false);
	}, { passive: true });

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

	var outline = document.querySelector('.article-outline');
	var toc = outline && outline.querySelector('.article-toc');
	var articleHeadings = document.querySelectorAll('.single-article-entry h2, .single-article-entry h3');
	if (outline && toc && articleHeadings.length > 1) {
		Array.prototype.forEach.call(articleHeadings, function (heading, index) {
			if (!heading.id) heading.id = 'noi-dung-' + (index + 1);
			var link = document.createElement('a');
			link.href = '#' + heading.id;
			link.className = heading.tagName === 'H3' ? 'is-sub' : '';
			link.textContent = heading.textContent.trim();
			toc.appendChild(link);
		});
		outline.hidden = false;
	}
})();
