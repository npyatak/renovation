/**
 * Регистрация обработчика событий onload.
 *
 * @see {function} workProcessInit().
 */
if (window.addEventListener) {
	window.addEventListener('load', workProcessInit, false);
} else if (window.attachEvent) {
	window.attachEvent('onload', workProcessInit);
}

function workProcessInit() {
	var items = document.getElementsByClassName('item'),
		fls = document.getElementsByClassName('fl'),
		frs = document.getElementsByClassName('fr'),
		hsw = document.getElementsByClassName('horizontal-scroll-wrapper')
		;

	for (var i = 0; i < items.length; i++) {
		items[i].onclick = function () {
			if (hasClass(this, 'active')) return;
			for (var j = 0; j < items.length; j++) {
				removeClass(items[j], 'active');
			}

			addClass(this, 'active');

			var currentdateIndex = parseInt(this.getAttribute('data-index'), 10);

			for (var j = 0; j < fls.length; j++) {
				removeClass(fls[j], 'active');
				removeClass(frs[j], 'active');
			}
			if (currentdateIndex != 0) {
				addClass(fls[currentdateIndex], 'active');
			}
			if (currentdateIndex != 20) {
				addClass(frs[currentdateIndex], 'active');
			}
		};
	}
	for (var z = 0; z < items.length; z++) {
		items[z].onwheel = function (event) {

			var currentdateIndex = parseInt(this.getAttribute('data-index'), 10);
			console.log(currentdateIndex);

			if (hasClass(this, 'active')) return;
			for (var j = 0; j < items.length; j++) {
				removeClass(items[j], 'active');
			}

			addClass(this, 'active');

			for (var j = 0; j < fls.length; j++) {
				removeClass(fls[j], 'active');
				removeClass(frs[j], 'active');
			}
			if (currentdateIndex != 0) {
				addClass(fls[currentdateIndex], 'active');
			}
			if (currentdateIndex != 20) {
				addClass(frs[currentdateIndex], 'active');
			}
		}
	};

	// Инициализация. Состояние по умолчанию.
	items[0].onclick();
	// hsw[0].addEventListener('mousewheel', onwheel);
	// hsw[0].addEventListener('mouseover', onwheel);

}

function hasClass(el, cl) {
	var regex = new RegExp('(?:\\s|^)' + cl + '(?:\\s|$)');
	return !!el.className.match(regex);
}

function addClass(el, cls) {
	var newClasses = cls.trim().split(' '),
		currentClasses = el.className;

	for (var i = 0; i < newClasses.length; i++) {
		if (!hasClass(el, newClasses[i])) {
			currentClasses += ' ' + newClasses[i];
		}
	}

	el.className = currentClasses.trim();
}

function removeClass(el, cls) {
	var removeClasses = cls.trim().split(' '),
		currentClasses = el.className;

	for (var i = 0; i < removeClasses.length; i++) {
		var regex = new RegExp('(?:\\s|^)' + removeClasses[i] + '(?:\\s|$)');
		currentClasses = currentClasses.replace(regex, ' ');
	}

	el.className = currentClasses.trim();
}

function toggleClass(el, cls) {
	var toggleClasses = cls.trim().split(' ');

	for (var i = 0; i < toggleClasses.length; i++) {
		if (hasClass(el, toggleClasses[i])) {
			removeClass(el, toggleClasses[i]);
		} else {
			addClass(el, toggleClasses[i]);
		}
	}
}

function addEvent(el, comEvent, ieEvent, func, bool) {
	if (window.addEventListener) {
		el.addEventListener(comEvent, func, bool);
	} else if (window.attachEvent) {
		el.attachEvent(ieEvent, func);
	}
}