var npSocial = document.querySelector(".np-social");

if(npSocial !== null){
    window.addEventListener("scroll", function(){
        if(window.pageYOffset >= document.documentElement.clientHeight){
            npSocial.classList.add("show");
        }
        else{
            npSocial.classList.remove("show");
        }
    }.bind(this));
}


var scrollButton1 = document.querySelector(".np-section_1 .np-section__scroll");
if(scrollButton1 !== null){
    scrollButton1.onclick = function(e){
        e.preventDefault();
        $('html, body').stop().animate({ scrollTop: $('.np-section_2').offset().top }, 500);
    }.bind(this);
}


var scrollButton3 = document.querySelector(".np-section_3 .np-section__scroll");
if(scrollButton3 !== null){
    scrollButton3.onclick = function(e){
        e.preventDefault();
        $('html, body').stop().animate({ scrollTop: $('.np-section_4_new').offset().top }, 500);
    }.bind(this);
}



var sectionFirst = document.querySelector(".np-section_full_first");
sectionFirst.style.height = (document.documentElement.clientHeight - 66) + 'px';

window.addEventListener("load", function(){
	sectionFirst.style.height = (document.documentElement.clientHeight - 66) + 'px';
}.bind(this));

window.addEventListener("resize", function(){
	sectionFirst.style.height = (document.documentElement.clientHeight - 66) + 'px';
}.bind(this));