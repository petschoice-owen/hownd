jQuery(function($) {
    const header = () => {
        $(document).on('click', '.js-header-search', function(e) {
            e.preventDefault();
            $('.header__search').toggleClass('open');
            $('.header__search .search-field').focus();
        });

        $(document).on('click', '.header__search-overlay', function(e) {
            e.preventDefault();
            $('.header__search').removeClass('open');
        });

        $(document).on('click', '.js-nav-toggler', function(e) {
            e.preventDefault();
            $('.mobile-nav').addClass('open');
        });

        $(document).on('click', '.mobile-nav-overlay, .js-close-mobile-nav', function(e) {
            e.preventDefault();
            $('.mobile-nav').removeClass('open');
        });

        $(document).on('click', '.mobile-nav .nav-item__arrow', function(e) {
            e.preventDefault();
            var parent = $(this).closest('li'),
                parent_ul = parent.closest('ul');
            if($(this).hasClass('open')) {
                $(this).removeClass('open');
                parent_ul.children('li').not(parent).show();
                $(this).parent('.dropdown-toggle').removeClass('open');
                $(this).parent('.dropdown-toggle').siblings('.dropdown-menu').removeClass('show');
                if($(this).closest('.dropdown-menu').length > 0) {
                    $(this).closest('.dropdown-menu').prev().show();
                }
            } else {
                $(this).addClass('open');
                parent_ul.children('li').not(parent).hide();
                $(this).parent('.dropdown-toggle').addClass('open');
                $(this).parent('.dropdown-toggle').siblings('.dropdown-menu').addClass('show');
                if($(this).closest('.dropdown-menu').length > 0) {
                    $(this).closest('.dropdown-menu').prev().hide();
                }
            }
            
        });

        $(document).on('click', '.js-mobile-search', function(e) {
            e.preventDefault();
            $('.mobile-search').addClass('open');
            $('.mobile-search .search-field').focus();
        });

        $(document).on('click', '.js-close-mobile-search', function(e) {
            e.preventDefault();
            $('.mobile-search').removeClass('open');
        });
        
        $(window).on('scroll', function() {
            if($(window).scrollTop() > $('.header').outerHeight()) {
                $('.header').addClass('fixed-header');
            }else {
                $('.header').removeClass('fixed-header');
            }
        });
    };

    const logoSlider = () => {
        if($('.js-footer-logo-slider').length > 0) {
            $('.js-footer-logo-slider').slick({
                dots: true,
                arrows: false,
                infinite: true,
                speed: 300,
                slidesToShow: 6,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 2000,
                responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 5,
                        slidesToScroll: 5,
                        infinite: true,
                        dots: true,
                        autoplay: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        autoplay: true
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        autoplay: true
                    }
                }
                ]
            });
        }
    };

    const bos4wInputRadio = () => {
        if($('.bos4w-display-options').length > 0) {
            $('.bos4w-display-options').find('input[type="radio"]').each(function() {
                $(this).on('change', function(e){
                    $('.bos4w-display-options').find('label').removeClass('checked');
                    if ($(this).is(':checked')) {
                        $(this).closest('label').addClass('checked');
                    }
                });
                if ($(this).is(':checked')) {
                    $(this).closest('label').addClass('checked');
                }
            });
        }
    };

    const productQuantity = () => {
        // Quantity buttons
        $(document).on('click', '.quantity .plus-btn, .quantity .minus-btn', function() {
            var $quantityInput = $(this).closest('.quantity').find('.qty');
            var currentValue = parseFloat($quantityInput.val());
            var max_value = $quantityInput.attr('max') ? parseFloat($quantityInput.attr('max')) : '';
            var step = $quantityInput.attr('step') ? parseFloat($quantityInput.attr('step')) : 1;
            if ($(this).is('.plus-btn')) {
                if (max_value !== '' && (max_value <= currentValue)) {
                    return;
                }
                $quantityInput.val(currentValue + step);
            } else {
                if (currentValue > 1) {
                    $quantityInput.val(currentValue - step);
                }
            }

            $quantityInput.trigger('change');
        });
    };

    const productAccordion = () => {
        if($('.single-product').length > 0) {
            $(document).on('click', '.hownd-tab-toggler', function(e) {
                e.preventDefault();
                $(this).closest('.woocommerce-tabs').find('.hownd-tab-toggler').not($(this)).removeClass('active');
                $(this).toggleClass('active');
            });
        }
    };

    const addToCart = () => {
        $('body').on('click', '.products .js-shop-atc', function(e) {
            e.preventDefault();
            
            var button = $(this);
            var product_id = button.data('product_id');
            var variation_id = button.data('variation_id');
            button.addClass('loading');
            // Make AJAX request to add to cart
            $.ajax({
                url: wc_add_to_cart_params.ajax_url,
                type: 'POST',
                data: {
                    action: 'woocommerce_add_to_cart',
                    product_id: product_id,
                    variation_id: variation_id,
                    quantity: 1
                },
                success: function(response) {
                    button.removeClass('loading');
                    if (response.error && response.product_url) {
                        window.location = response.product_url;
                    } else {
                        $(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, button]);
                    }
                }
            });
        });

        $('body').on('click', '.products .js-shop-atc-variable', function(e) {
            e.preventDefault();
            
            var button = $(this);
            var product_id = button.data('product_id');
            var variation_id = button.data('variation_id');
            button.addClass('loading');
            // Make AJAX request to add to cart
            $.ajax({
                url: ajax_vars.ajax_url,
                type: 'POST',
                data: {
                    action: 'hownd_var_add_to_cart',
                    product_id: product_id,
                    variation_id: variation_id,
                    quantity: 1
                },
                success: function(response) {
                    button.removeClass('loading');
                    if (response.success) {
                        button.addClass('added');
                        $(document.body).trigger('added_to_cart', [response.data.fragments, response.data.cart_hash, button]);
                    } else {
                       
                    }
                }
            });
        });
    };

    const filterFlyout = () => {
        $('body').on('click', '.js-filter-trigger', function(e) {
            e.preventDefault();

            var id = $(this).attr('href');
            $('.filter-flyout').not(id).removeClass('open');
            $(id).toggleClass('open');
        });

        $('body').on('click', '.filter-flyout__close', function(e) {
            e.preventDefault();
            $(this).closest('.filter-flyout').removeClass('open');
        });

        $('#filterRange').on('submit', function(event) {
            event.preventDefault();
    
            var selectedTags = $('#filterRange input[name="product_tag"]:checked').map(function() {
                return $(this).val();
            }).get().join('+');
    
            var orderby = $('#filterSort input[name="orderby"]:checked').val() || '';
            var url = '?product_tag=' + encodeURIComponent(selectedTags);
            if (orderby) {
                url += '&orderby=' + encodeURIComponent(orderby);
            }
            if($('.shop-actions__view a.active').length > 0) {
                url += '&products_per_page=' + $('.shop-actions__view a.active').text();
            }
            window.location.href = url;
        });
    
        $('#filterSort').on('submit', function(event) {
            event.preventDefault();
            var orderby = $('#filterSort input[name="orderby"]:checked').val() || '';
            var selectedTags = $('#filterRange input[name="product_tag"]:checked').map(function() {
                return $(this).val();
            }).get().join('+');
            var url = '?product_tag=' + encodeURIComponent(selectedTags);
            if (orderby) {
                url += '&orderby=' + encodeURIComponent(orderby);
            }
            if($('.shop-actions__view a.active').length > 0) {
                url += '&products_per_page=' + $('.shop-actions__view a.active').text();
            }
            window.location.href = url;
        });
    };

    const miniCart = () => {
        $('body').on('click', '.header__cart-count', function(e) {
            e.preventDefault();
            $('.header__quickcart').addClass('open');
        });

        $('body').on('click', '.header__quickcart-overlay, .header__quickcart-close', function(e) {
            e.preventDefault();
            $('.header__quickcart').removeClass('open');
        });
    };

    const wpStoreLocator = () => {
        if($('.wp-store-locator').length > 0) {
            $('#wpsl-search-input').attr('placeholder','Type a postcode or address...');
        }
    };

    const howndClubPopup = () => {
        $('.js-hownd-club-trigger').on('click', function(e) {
            e.preventDefault();

            $('#howndClubPopup').addClass('open');
        });

        $('body').on('click', '.js-close-popup', function(e) {
            e.preventDefault();

            $(this).closest('.popup').removeClass('open');
            if( 'donatePopup' === $(this).closest('.popup').attr('id') ) {
                $(this).closest('.popup').find('.text-danger').remove();
            }
        });
    };

    const scrollToTop = () => {
        $('.js-scrolltop').on('click', function(e) {
            e.preventDefault();

            $('html, body').animate({
                scrollTop: 0
            }, 10);
        });
    };

    const allDogsMatter = () => {
          // Define the function to call on change
        function onChangeLauncher() {
            $('.wll-fixed_cart-container').each(function() {
                var cartName = $(this).find('.wll-fixed_cart-name').text();
                if (cartName === 'Donate to All Dogs Matter') {
                    $(this).addClass('donate-block');
                    var button = $(this).find('button#wll-fixed_cart-redeem-button');
                    button.on('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        $('#donatePopup').addClass('open');
                    });
                }
            });

            $('.wll-preview-followup_share-container').each(function() {
                if($(this).find('.wll-preview-followup_share-name > .wll-flex:eq(0) > p').text() === 'Sign up to our mailing list') {
                    $(this).addClass('js-follow-newsletter');
                }
            });
        }

        $(document).on('click', '.js-follow-newsletter .wll-preview-followup_share-description, .js-account-follow-newsletter .wlr-description', function(e) {
            e.preventDefault();
            $('html, body').animate({
                scrollTop: $('.footer__newsletter-text').offset().top
            }, 10);
        });

        // Create a new instance of MutationObserver
        const observer = new MutationObserver((mutations) => {
            mutations.forEach((mutation) => {
                onChangeLauncher(); // Call the function whenever a change is detected
            });
        });

        // Select the target node
        const targetNode = document.getElementById('wll-site-launcher');
        const config = { childList: true, subtree: true, characterData: true };
        observer.observe(targetNode, config);
    };


    const allDogsMatterAccount = () => {
        if($('#wlr-my-rewards-sections').length > 0) {
            $('.wlr-reward-card').each(function() {
                var cartName = $(this).find('.wlr-pre-text').text().trim();
                if (cartName.toLowerCase().indexOf("donate") >= 0) {
                    $(this).addClass('donate-block');
                    var button = $(this).find('.wlr-button-reward');
                    button.attr('onclick', '');
                    button.off('click').on('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        $('#donatePopup').addClass('open');
                    });
                }
            });
        }
    };

    const signUpMailingList = () => {
        if($('.wlr-campaign-container').length > 0) {
            $('.wlr-campaign-container .wlr-card').each(function() {
                var cartName = $(this).find('.wlr-pre-text.wlr-description').text();
                if (cartName === 'Subscribe') {
                    $(this).addClass('js-account-follow-newsletter');
                }
            });
        }
    };

    header();
    logoSlider();
    bos4wInputRadio();
    productQuantity();
    productAccordion();
    addToCart();
    filterFlyout();
    miniCart();
    wpStoreLocator();
    howndClubPopup();
    scrollToTop();
    allDogsMatter();
    allDogsMatterAccount();
    signUpMailingList();
});