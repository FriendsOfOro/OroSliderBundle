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

    ```bash
    (...)
    'repositories": {
    
     "friendsoforo/oro-recaptcha-bundle": {
       "type": "vcs",
       "url": "git@github.com:FriendsOfOro/OroRecaptchaBundle.git"
     }
    (...)

    ```
And execute :

    ```bash
    composer require friendsoforo/oro-slider-bundle
    ```
    
2. Purge Oro cache:
    ```bash
    php bin/console cache:clear --env=prod
    ```
3. Login to Oro Admin
1. Navigate to **Marketing => Sliders**

Usage with Layout
-------------------
**Example**

1. Create a slider with code `home-page-slider`
2. Create slides in this slider
3. Add new block (text) in layout file:

        - '@addTree':
            items:
                home_page_slider:
                    blockType: text
                    options:
                        text: "=data['slider'].getSlidesBySliderCode('home-page-slider')"
            tree:
                page_content:
                    home_page_slider: ~

Roadmap / Remaining Tasks
-------------------
- [ ] Clean SliderSelectType (without plus)
- [ ] Selected slider when create a slide from a slider view
- [ ] Add restrictions (customer/customer group/website) on slide

Licence
-------------------
[MIT - MIT License](./LICENSE)
