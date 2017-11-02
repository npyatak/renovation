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
	var scrollContainer = document.getElementsByClassName('sliderbox')[0];
	var items = document.getElementsByClassName('item'),
		descriptions = document.getElementsByClassName('description'),
		fls = document.getElementsByClassName('fl'),
		frs = document.getElementsByClassName('fr'),
		currentdateIndex = 0;

	itemsLength = items.length;
	offset = scrollContainer.offsetLeft;
	scrollContainer.style.marginLeft = offset + 'px';

	for (var i = 0; i < fls.length; i++) {
		fls[i].onclick = function () {

			for (var j = 0; j < itemsLength; j++) {
				removeClass(items[j], 'active');
				removeClass(fls[j], 'active');
				removeClass(frs[j], 'active');
			}

			currentdateIndex = parseInt(this.getAttribute('data-index'), 10);
			addClass(items[currentdateIndex - 1], 'active');

			if (currentdateIndex > 1) {
				addClass(fls[currentdateIndex - 1], 'active');
			}

			if (currentdateIndex < itemsLength) {
				addClass(frs[currentdateIndex - 1], 'active');
			}

			if (currentdateIndex == 1) {
				scrollContainer.style.marginLeft = offset + 'px';
			} else {
				scrollContainer.style.marginLeft = -items[currentdateIndex - 1].offsetLeft + offset + 'px';
			}
		};
	}

	for (var i = 0; i < frs.length; i++) {
		frs[i].onclick = function () {

			for (var j = 0; j < itemsLength; j++) {
				removeClass(frs[j], 'active');
				removeClass(fls[j], 'active');
				removeClass(items[j], 'active');
			}

			currentdateIndex = parseInt(this.getAttribute('data-index'), 10);
			addClass(items[currentdateIndex + 1], 'active');

			if (currentdateIndex > -1) {
				addClass(fls[currentdateIndex + 1], 'active');
			}

			if (currentdateIndex != itemsLength - 2) {
				addClass(frs[currentdateIndex + 1], 'active');
			}

			scrollContainer.style.marginLeft = -items[currentdateIndex + 1].offsetLeft + offset + 'px';
		}
	}

	var ind = 0;

	scrollContainer.addEventListener('mousewheel', function (evt) {
		var rectEl = scrollContainer.getBoundingClientRect();
		if ((rectEl.top > -50 && rectEl.top < 100) && (ind > -1 && ind < itemsLength)) {
			for (var j = 0; j < itemsLength; j++) {
				removeClass(fls[j], 'active');
				removeClass(frs[j], 'active');
				removeClass(items[j], 'active');
			}
			if (evt.deltaY < 0) {
				ind--;
				if (ind == 0) {
					scrollContainer.style.marginLeft = offset + 'px';
				} else {
					scrollContainer.style.marginLeft = -items[ind].offsetLeft + offset + 'px';
				}
			} else {
				ind++;
				scrollContainer.style.marginLeft = -items[ind].offsetLeft + offset + 'px';
			}

			if (ind > -1 && ind < itemsLength) {
				evt.preventDefault();
				addClass(items[ind], 'active');
				if (ind != 0) {
					addClass(fls[ind], 'active');
				}
				if (ind != itemsLength - 1) {
					addClass(frs[ind], 'active');
				}
			}
		} else {
			ind = 0;
			scrollContainer.style.marginLeft = offset + 'px';
			addClass(items[ind], 'active');
			addClass(frs[ind], 'active');
		}
	});
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