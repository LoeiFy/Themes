/**
 * Version: 2.0
 * Author: LoeiFy
 * URL: http://lorem.in
 */

// define
var currentpostid,                                  // current post id
    postid,                                         // to load post id
    url,                                            // ajax to load url

    loadpost = 3,                                   // define preload posts

    canload = touchDevice() ? false : true,         // ajax can load mark

    totalpost = 0,                                  // total post section
    position = 0,                                   // section position

    currenturl,                                     // current url
    currenttitle,                                   // current title

    historystates = new Array,                      // history states

    hometitle = document.title.indexOf(' ') != -1 ? document.title.split(' ')[0] : document.title,
    urlpath = location.pathname,                    // if to load more

    postnumber = 0,                                 // load post number

    sliderPos = 0,                                  // slider position
    totalslider = 0,                                // total sliders

    mousemark = true,                               // mousemove mark
    scrollmark = true;                              // can scroll mark

// ready !
$(function($) {

    // some tag
    $('#container').after('<div id="pot"></div><div class="cover"></div>')

    // show about
    $('.menu').hammer({prevent_default: true}).on('tap', function() {
        $('#container, .cover, .about').addClass('active')
        return false;
    })
    $('.cover, .close').hammer({prevent_default: true}).on('tap', function(e) {
        $('#container, .cover, .about').removeClass('active')
    })

    $('.about h2 a').hammer({prevent_default: true}).on('tap', function(e) {
        location.href="/";
    })

    setTimeout(resizePage, 0)

    // replace current history state
    currenturl = $('.post').data('link') || window.location.href;
    currenttitle = hometitle +' - '+ $('.post').data('title');
    history.replaceState({ url: currenturl, title: currenttitle, position: 0 }, currenttitle, currenturl)
    document.title = currenttitle;

    // get current post id and to load url 
    postid = $('.post').data('id');
    currentpostid = postid;
    url = $('#post'+ postid).data('prev');

    // save current history state
    historystates.push([currenturl, currenttitle, currentpostid])

    // show content
    setTimeout(function() {
        $('.post').animate({'opacity': 1}, 200, 'ease')
        $('body').addClass('done').css('background-color', $('.post').data('bg'))
        $('#pot').css('background-color', $('.post').data('color'))
        // ajax load post
        if (url && urlpath == '/') toLoad();
    }, 1000)

    // get current sliders number
    sliderInfo('#post'+ historystates[position][2])

    // on screen size change
    $(window).on('resize orientationchange', function(){
        setTimeout(resizePage, 0)
    })

    // tap or click
    onTap('.post')

    // get slider info
    function sliderInfo(tag) {
        // reset slider
        sliderPos = 0;
        $('.dots').remove()
        $('.post ul').css('left', 0)

        totalslider = $(tag).find('li').length;
        $(tag).find('ul').css('width', totalslider * window.innerWidth)
        $(tag).find('li').css('width', window.innerWidth)

        var s = '<div id="dot'+ historystates[position][2] +'" class="dots">';
        for (var i = 0; i < totalslider; i ++) {
            s += '<span style="border-color: '+ $(tag +' ul').css('color') +'" class="'+ (i == 0 ? 'active' : '') +'"></span>';
        }
        s += '</div>';
        $(tag).append(s)
    }

    // resize page
    function resizePage() {
        $('.post').height(window.innerHeight)
        $('#wrapper').height($('.post').length * window.innerHeight)
        sectionMove(position)
        $('#post'+ historystates[position][2]).find('ul').css('width', totalslider * window.innerWidth)
        $('#post'+ historystates[position][2]).find('li').css('width', window.innerWidth)
        sliderMove('#post'+ historystates[position][2] +' ul', sliderPos)
    }

    // page move down
    function sectionDown() {
        if (position < totalpost) {
            position ++;
            sectionMove(position, function() {
                pState(historystates[position][0], historystates[position][1], position)
                sliderInfo('#post'+ historystates[position][2])
                $('body').css('background-color', $('#post'+ historystates[position][2]).data('bg'))
                $('#pot').css('background-color', $('#post'+ historystates[position][2]).data('color'))

                if (canload && url && urlpath == '/' && ($('section').length > loadpost)) toLoad();
            })
        } else {
            if (touchDevice() && url) {
                window.location.href = url 
            } else {
                sectionBottom(position)
            }
        }
    }

    // page move up
    function sectionUp() {
        if (position >= 1) { 
            position --;
            sectionMove(position, function() {
                pState(historystates[position][0], historystates[position][1], position)
                sliderInfo('#post'+ historystates[position][2])
                $('body').css('background-color', $('#post'+ historystates[position][2]).data('bg'))
                $('#pot').css('background-color', $('#post'+ historystates[position][2]).data('color'))
            })
        } else {
            sectionTop()
        }
    }

    // slider move left
    function sliderLeft(id) {
        if (sliderPos >= 1) {
            sliderPos --;
            sliderMove(id, sliderPos)
            $('#dot'+ historystates[position][2] +' span').removeClass('active').eq(sliderPos).addClass('active')
        } else {
            leftEnd(id)
        }
    }

    // slider move right
    function sliderRight(id) {
        if (sliderPos < totalslider - 1) {
            sliderPos ++;
            sliderMove(id, sliderPos, function() {
                loadImg('#img'+ historystates[position][2] + sliderPos)
            })
            $('#dot'+ historystates[position][2] +' span').removeClass('active').eq(sliderPos).addClass('active')
        } else {
            rightEnd(id, sliderPos)
        }
    }

    // mouse click or tap event
    function onTap(id) {
        tapPlot(id, '#pot', function(x, y, u) {
            if ($(u).hasClass('tolink')) {
                if (touchDevice()) window.open($(u).attr('href'));
                return;
            }
            x = x - Math.floor(x);
            y = y - Math.floor(y);

            var id = '#post'+ historystates[position][2];

            if (x > 0.6) sliderRight(id +' ul');
            if (x < 0.4) sliderLeft(id +' ul');
        })
    }

    // ajax load post
    function toLoad() {
        if (!canload) return;
        canload = false; 

        if (postnumber > (loadpost - 1)) { 
            postnumber --;
            canload = true;
            return;
        }

        ajaxLoad(url, function(data) {
            postnumber ++;

            var data = $(data).find('section');
            $('#post'+ postid).after(data)

            totalpost ++;
            
            canload = true;

            postid = data.data('id');
            url = $('#post'+ postid).data('prev');

            onTap('#post'+ postid)

            $('#post'+ postid +' .menu').hammer({prevent_default: true}).on('tap', function() {
                $('#container, .cover, .about').addClass('active')
                return false;
            })

            $('#post'+ postid).height(window.innerHeight).css('opacity', 1)

            var posturl = $('#post'+ postid).data('link'),
                posttitle = hometitle +' - '+ $('#post'+ postid).data('title');
            historystates.push([posturl, posttitle, postid])    // save post state

            if (url) toLoad();
        }, function() {
            canload = true;
            toLoad()
        })
    }

    // keyboard event
    $(document).on('keydown', function(e) {

        var id = '#post'+ historystates[position][2];
        switch (e.keyCode) {

            case 40:    // down
                sectionDown()
            break;

            case 38:    // up
                sectionUp()
            break;

            case 39:    // right
                sliderRight(id +' ul')
            break;

            case 37:    // left
                sliderLeft(id +' ul')
            break;

            case 9:     // tab
                return false;
            break;

        }
    })

    // popstate event
    window.addEventListener('popstate', function(e) {
        var states = e.state;
        if (!states) return;
        if (urlpath != '/') location.href = '/';    // not home page reload

        document.title = states.title;
        position = states.position;

        sectionMove(position)
        sliderInfo('#post'+ historystates[position][2])
    })

    // mousescroll event
    $('body').on('mousewheel DOMMouseScroll', function(e) {
        e.preventDefault()
        var data = e.originalEvent.wheelDelta || e.originalEvent.detail * -1;

        var time = 500;
        if (navigator.platform == 'MacIntel' || navigator.platform == 'MacPPC') time = 1500;

        if (scrollmark) {
            scrollmark = false;

            if (data < 0) {     // down
                sectionDown()
            }
            if (data > 0) {     // up
                sectionUp()
            }

            setTimeout(function() {scrollmark = true}, time)
        }
    })

    // swipe event
    $('html').hammer({
        prevent_default: true
    }).on('swipe', function(e) {

        var id = '#post'+ historystates[position][2];

        switch (e.direction) {

            case 'up':
                sectionDown()
            break;

            case 'down':
                sectionUp()
            break;

            case 'right':
                sliderLeft(id +' ul')
            break;

            case 'left':
                sliderRight(id +' ul')
            break;

        }
    })

    console.info("https://github.com/LoeiFy")

})
