 Oro Slider Bundle
==============================
The bundle adding slider and slide management in OroCommerce

Requirements
-------------------
* Oro Commerce 3.1

Installation
-------------------
1. Install via Composer

Add repository in composer :

    (...)
    'repositories": {
    
     friendsoforo/oro-slider-bundle": {
       "type": "vcs",
       "url": "git@github.com:FriendsOfOro/OroSliderBundle.git"
     }
    (...)


And execute :

    composer require friendsoforo/oro-slider-bundle

    
2. Purge Oro cache:
    ```bash
    php bin/console cache:clear --env=prod
    ```
3. Login to Oro Admin

4. Navigate to **Marketing => Sliders**

Usage with Layout
-------------------
**Base example**

1. Create a slider with code `home-page-slider`
2. Create slides in this slider

**Custom template**

- Add new block (text) in layout file:

        - '@addTree':
            items:
                home_page_slider:
                    blockType: text
                    options:
                        text: "=data['slider'].getSlidesBySliderCode('home-page-slider')"
            tree:
                page_content:
                    home_page_slider: ~

- Edit the twig file :
```
{% block _home_page_slider_widget %}
    {% import 'OroProductBundle::image_macros.html.twig' as Image %}
    {% set slides = text %}
    {% set attr = layout_attr_defaults(attr, {
        'data-page-component-module': 'orofrontend/js/app/components/list-slider-component',
        'data-page-component-options': {
            slidesToShow: 1,
            autoplay: true,
            autoplaySpeed: 4000,
            arrows: false,
            dots: true
        },
        '~class': ' promo-slider'
    }) %}
    <div {{ block('block_attributes') }}>
        {% for slide in slides %}
            <div class="promo-slider__item slider_order_{% if slide.sortOrder %}{{ slide.sortOrder }}{% endif %}">
                {% if slide.picture %}
                    {% if slide.url %}<a href="{{ slide.url }}">{% endif %}
                        <div class="promo-slider__picture">
                            <img src="{{ Image.url(slide.picture, 'product_original') }}"  alt="" />
                        </div>
                    {% if slide.url %}</a>{% endif %}
                {% endif %}
                {% if slide.description %}
                    <div class="promo-slider__info promo-slider__info--center-mode promo-slider__info--text-color-dark">
                        {% if slide.name %}<h2 class="promo-slider__title">{{ slide.name }}</h2>{% endif %}
                        <div class="promo-slider__description">
                            {{ slide.description|raw }}
                        </div>
                        {% if slide.url and slide.button %}
                            <a href="{{ slide.url }}" class="btn btn--info promo-slider__view-btn">
                                {{ slide.button }}
                            </a>
                        {% endif %}
                    </div>
                {% endif %}
            </div>
        {% endfor %}
    </div>
{% endblock %}                    
```

Roadmap / Remaining Tasks
-------------------
- [ ] Clean SliderSelectType (without plus)
- [ ] Selected slider when create a slide from a slider view
- [ ] Add restrictions (customer/customer group/website) on slide

Licence
-------------------
[MIT - MIT License](./LICENSE)
