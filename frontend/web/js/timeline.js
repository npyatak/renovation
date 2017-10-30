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
		currentdateIndex = 0,
		prevInd = 0;
	;

	for (var i = 0; i < items.length; i++) {
		items[i].onclick = function () {
			if (hasClass(this, 'active')) {
				return;
			}
			for (var j = 0; j < items.length; j++) {
				removeClass(items[j], 'active');
			}

			addClass(this, 'active');

			currentdateIndex = parseInt(this.getAttribute('data-index'), 10);
			prevInd = currentdateIndex;

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

	var ind = 0;

	scrollContainer.addEventListener('mousewheel', function (evt) {

		var rectEl = scrollContainer.getBoundingClientRect();
		if ((rectEl.top > 0 && rectEl.top < 75) && (ind > -1 && ind < 21)) {
			var currentdateIndex = ind;
			removeClass(items[currentdateIndex], 'active');
			removeClass(fls[currentdateIndex], 'active');
			removeClass(frs[currentdateIndex], 'active');
			if (evt.deltaY < 0) {
				ind--;
				removeClass(items[currentdateIndex + 1], 'active');
				removeClass(fls[currentdateIndex + 1], 'active');
				removeClass(frs[currentdateIndex + 1], 'active');
				scrollContainer.style.marginLeft = (items.length - 1 - currentdateIndex * items[0].offsetWidth) + 'px';
				addClass(items[currentdateIndex], 'active');
				if (currentdateIndex != 0) {
					addClass(fls[currentdateIndex], 'active');
				}
				if (currentdateIndex != 20) {
					addClass(frs[currentdateIndex], 'active');
				}
			} else {
				ind++;
				scrollContainer.style.marginLeft = (-currentdateIndex * items[0].offsetWidth) + 'px';
			}

			if (ind > -1 && ind < 21) {
				evt.preventDefault();
				var activeItem = items[ind];
				addClass(activeItem, 'active');
				if (ind != 0) {
					addClass(fls[ind], 'active');
				}
				if (ind != 20) {
					addClass(frs[ind], 'active');
				}
			}
		} else {
			ind = 0;
		}
		console.log(rectEl);
		// evt.preventDefault();
	});

	items[0].onclick();

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