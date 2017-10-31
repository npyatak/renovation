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
		fls = document.getElementsByClassName('fl'),
		frs = document.getElementsByClassName('fr'),
		currentdateIndex = 0;

	itemsLength = items.length;

	for (var i = 0; i < fls.length; i++) {
		fls[i].onclick = function () {

			for (var j = 0; j < fls.length; j++) {
				removeClass(fls[j], 'active');
			}

			for (var j = 0; j < frs.length; j++) {
				removeClass(frs[j], 'active');
			}

			currentdateIndex = parseInt(this.getAttribute('data-index'), 10);

			removeClass(items[currentdateIndex], 'active');
			addClass(items[currentdateIndex - 1], 'active');

			if (currentdateIndex > 1) {
				addClass(fls[currentdateIndex - 1], 'active');
			}

			if (currentdateIndex < frs.length) {
				addClass(frs[currentdateIndex - 1], 'active');
			}

			scrollContainer.style.marginLeft = ((currentdateIndex - 1) * -items[0].offsetWidth) + 'px';
		};
	}

	for (var i = 0; i < frs.length; i++) {
		frs[i].onclick = function () {

			for (var j = 0; j < frs.length; j++) {
				removeClass(frs[j], 'active');
			}
			for (var j = 0; j < fls.length; j++) {
				removeClass(fls[j], 'active');
			}

			currentdateIndex = parseInt(this.getAttribute('data-index'), 10);

			removeClass(items[currentdateIndex], 'active');
			addClass(items[currentdateIndex + 1], 'active');

			if (currentdateIndex > -1) {
				addClass(fls[currentdateIndex + 1], 'active');
			}

			if (currentdateIndex + 2 < frs.length) {
				addClass(frs[currentdateIndex + 1], 'active');
			}

			scrollContainer.style.marginLeft = ((currentdateIndex + 1) * -items[0].offsetWidth) + 'px';
		};
	}

	var ind = 0;

	document.addEventListener('mousewheel', function (evt) {
		var rectEl = scrollContainer.getBoundingClientRect();
		if ((rectEl.top > 0 && rectEl.top < 120) && (ind > -1 && ind < itemsLength)) {
			var currentdateIndex = ind;
			removeClass(fls[currentdateIndex], 'active');
			removeClass(frs[currentdateIndex], 'active');
			if (currentdateIndex > 0) {
				removeClass(items[currentdateIndex], 'active');
			}
			if (evt.deltaY < 0) {
				ind--;
				if (ind > -1) {
					scrollContainer.style.marginLeft = (items.length - ind * items[0].offsetWidth) + 'px';
				}
			} else {
				ind++;
				if (ind < items.length - 1) {
					scrollContainer.style.marginLeft = (-ind * items[0].offsetWidth) + 'px';
				}
			}

			if (ind > -1 && ind < itemsLength) {
				evt.preventDefault();
				var activeItem = items[ind];
				addClass(activeItem, 'active');
				if (ind != 0) {
					addClass(fls[ind], 'active');
				}
				if (ind != itemsLength - 1) {
					addClass(frs[ind], 'active');
				}
			}
		} else {
			ind = 0;
		}
		console.log(rectEl);
		// evt.preventDefault();
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