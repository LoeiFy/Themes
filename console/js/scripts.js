var url = window.location.href;
    
// define pushState mark
var pm = true;

// post id
var pid = 0;

// postwrap
var gi = 0;

// group
var group = 0;

$(function() {

    $(document).on('click', '.typo img', function(e) { 
        e.stopPropagation()
        $(this).toggleClass('enlarge')
        return false;
    }).on('mouseleave', '.typo img', function() {
        $(this).removeClass('enlarge')
    })

    $(window).on('keydown', function(e) {
        if (e.keyCode == 17) $('.status').addClass('icon-open');
    }).on('keyup', function() {
        $('.status').removeClass('icon-open')
    })

    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('#top').fadeIn()
        } else {
            $('#top').fadeOut()
        }
    })

    $('#top').click(function() {
		setTimeout(scrollTo, 0, 0, 0)
	})

    $('.nav a').hover(function() {
        $('.nav a').css('color', 'transparent').css('text-shadow', '0 0 3px rgba(0,0,0,.3)')
        $(this).css('color', '#666').css('text-shadow', 'none')
    }, function() {
        $('.nav a').css('color', '#666').css('text-shadow', 'none')
    })

    $('#pagination span').each(function() {
        if ($(this).find('a').length) $(this).addClass('active');
    })

    var sd = $('#slider ul').bxSlider({
        auto: true,
        captions: true,
        controls: false,
        pause: 7000
    });

    $('#slider img').on('click', function() {
        sd.goToNextSlide()
        sd.stopAuto()
    })

    if (window.history && history.pushState) {
		history.replaceState({url: url, title: document.title }, document.title, url)
        postView()
        poState()
    }

    $('.post').on('mouseenter', function() {
        $('#postwrap'+ gi).height($('#postwrap'+ gi).height())
    })

    function comment() {
        $('#add_comment').click(function(e) {
	   	    e.preventDefault();
            $('#postwrap'+ gi).css('height', 'auto')

            var id = $(this).data('id');
			$('#comment-box').html('loading...');

			$.getScript('http://static.duoshuo.com/embed.js', function() {
				var el = document.createElement('div');
    			el.setAttribute('data-thread-key', id);
    			DUOSHUO.EmbedThread(el);
    			$('#comment-box').html(el);
			})

	   		$(this).remove();
		})//.trigger('click')
    }

    comment()

    function poState() {

        window.addEventListener('popstate', function(e) {
            var state = e.state;

            if (!state) return;

            document.title = state.title;

            if (state.url == url) { 
                pm = true;
                $('.post').removeClass('active').find('.dash').stop().animate({left:'0'}, 500)
                setTimeout(function() {
                    $('.postwrap').height(0)
                }, 500)
                $('a.status').removeClass('icon-resize-shrink').addClass('icon-resize-enlarge')
                $('#close').fadeOut()
            } else {

                $('.postwrap').height(0)

                setTimeout(function() {
                    getPost(state.url, state.title, function() {})
                }, pm ? 0 : 500)
            }

        })

    }

    function getPost(url, title, f) {

        $('.post').removeClass('active').find('.dash').stop().animate({left:'0'}, 500)

        $('.post').each(function() {
            if ($(this).data('post') == pid) {
                $(this).find('.dash').stop().animate({left:'290px'}, 8000)
            }
        })

        $.ajax({
            type: 'GET',
            url: url,
            timeout: 7000,
            success: function(data) {

                f()

                $('.postwrap').html('')

                data = $(data).find('.postcontent');

                $('<div id="temp" style="left: -9999px; position: absolute; z-index: -1"></div>').appendTo('body').html(data)

                $('#temp .postleft').find('img').hide()

                var ch = $('#temp').height();

                $('#temp').remove()

                $('#postwrap'+ gi).html(data)

                var imgh = 0, typow = $('.typo').width();
                $('.postleft').find('img').each(function() {
                    $(this).show().parent().attr('target', '_blank')
                    if ($(this).attr('width') > typow) {
                        imgh += typow * $(this).attr('height') / $(this).attr('width');
                    } else {
                        imgh += $(this).attr('height');
                    }
                })

                $('#postwrap'+ gi).height(ch + imgh + 50)

                $('.post').each(function() {
                    if ($(this).data('post') == pid) {
                        var tag = $(this);
                        tag.find('.dash').stop().animate({left:'290px'}, 500)
                        setTimeout(function() {
                            tag.addClass('active')
                            $('a.status').removeClass('icon-resize-shrink').addClass('icon-resize-enlarge')
                            tag.find('a.status').removeClass('icon-resize-enlarge').addClass('icon-resize-shrink')
                        }, 500)
                    }
                })

                $('#close').fadeIn().off('click').on('click', function() {
                    $('#postwrap'+ gi).height($('#postwrap'+ gi).height())
                    history.back()
                })

                comment()

                setTimeout(function() {
                    $('#postwrap'+ gi).css('height', 'auto')
                    $.scrollTo('#postwrap'+ gi, { duration:500 })
                }, 500)

                $('pre code').each(function(i, block) {
                    hljs.highlightBlock(block);
                });

                initLike()

            },
            error: function() {
                window.location.href = url;
            }
        })
    }


    function postView() {

        $('.postlink').click(function(e) {
            if ($('a.status').hasClass('icon-open')) return true;
            e.preventDefault()

            sd.stopAuto()

            var it = $(this),
                url = it.attr('href'),
                title = it.attr('title'),
                postid = it.data('post');

            if ($('#'+ postid).hasClass('active')) {
                history.back()
                return false;
            }

            pid = $('#'+ postid).data('post');
            group = $('#'+ postid).data('post') / 3;

            $('.group').each(function() {
                if ($(this).html() == '') $(this).remove()
            })

            var postgroup = Math.ceil($('.post').length / 3);
            if (!$('#postwrap'+ postgroup).length) $('#primary').append('<div class="w postwrap oh" id="postwrap'+ postgroup +'"></div>')

            switch (true) {

                case group <= 1:
                    gi = 1;
                break;

                case group <= 2 && group > 1:
                    gi = 2;
                break;

                case group <= 3 && group > 2:
                    gi = 3;
                break;

                case group <= 4 && group > 3:
                    gi = 4;
                break;

            }

            $('.postwrap').height(0)

            setTimeout(function() {
                getPost(url, title, function() {
                    if (pm) {
                        history.pushState({ url: url, title: title }, title, url)
                        pm = false;
                    } else {
                        history.replaceState({ url: url, title: title }, title, url);
                    }

                    document.title = title;
                })
            }, pm ? 0 : 500)
        
            $('.post').removeClass('active')

        })

    }

    function initLike() {
		function reloadLikes(who) {
			var text = $('#' + who).html();
			var patt= /(\d)+/;
		
			var num = patt.exec(text);
			num[0]++;
			text = text.replace(patt,num[0]);
			$('#' + who).html('<span class="count">' + text + '</span>');
		};	

		$('.likeThis').click(function() {
			var classes = $(this).attr('class');
			classes = classes.split(' ');
			
			if(classes[1] == 'active') return false;

			var classes = $(this).addClass('active');
			var id = $(this).attr('id');
			id = id.split('like-');
			$.ajax({
				type: 'POST',
				url: 'index.php',
				data: 'likepost=' + id[1],
				success: reloadLikes('like-' + id[1])
			});
				
			return false;
		})
	}

    initLike()

    $('pre code').each(function(i, block) {
        hljs.highlightBlock(block);
    });

})
