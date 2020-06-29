const iconoMenu = document.getElementById('iconoMenu');
const menu = document.getElementById('modalMenu');
const cerrarModal = document.getElementById('cerrarModal');

const linksNavegacion = $('.navegacion').find('a');

let porClick = false;

iconoMenu.addEventListener('click', function () {
    if (menu.classList.contains('visible'))
    {
        menu.classList.remove('visible');
    }
    else
    {
        menu.classList.add('visible');
    }
});

cerrarModal.addEventListener('click', function () {
    if (menu.classList.contains('visible'))
    {
        menu.classList.remove('visible');
    }
    else
    {
        menu.classList.add('visible');
    }
});

for (let j = 0; j < linksNavegacion.length; j++) {
    linksNavegacion[j].addEventListener('click', function (event) {
        event.target.classList.add('activa');
        for (let i = 0; i < linksNavegacion.length; i++) {
            if (linksNavegacion[i] !== event.target) {
                if (linksNavegacion[i].classList.contains('activa')) {
                    linksNavegacion[i].classList.remove('activa');
                    linksNavegacion[i].classList.add('inactiva');
                }
            }
        }

        porClick = true;

        var active_section = $(this).attr('href'); //get active section id
        $('html, body').animate({
            //and scroll to the section
            scrollTop: $(active_section).offset().top
        }, 500);

        setTimeout(function () {
            porClick = false;
        }, 500);
    });
}

document.addEventListener('scroll', function () {
    if (!porClick) {
        //get document scroll position
        var position = $(document).scrollTop();
        //get header height
        var header = $('#homepageHeader').outerHeight();

        //check active section
        $('section').each(function(i) {
            if($(this).position().top - 10 <= position)
            {
                $(".navegacion").find('a.activa').removeClass('activa').addClass('inactiva');
                $(".navegacion").find('a').eq(i).addClass('activa').removeClass('inactiva');
            }
        });
    }
});