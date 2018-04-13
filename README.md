# simple-homepage

An even simpler, fully responsive Homepage. Ideal for Desktop and mobile usage!
Based on: https://github.com/thetomester13/homepage

This project uses:
- jQuery
- Bootstrap CSS
- Mousetrap.js
- Trianglify
- Font Awesome
- Unsplash

## Screenshots
![Homepage Desktop](example_img/homepage-desktop.png?raw=true)
![Homepage Mobile](example_img/homepage-mobile.png?raw=true)
![Homepage Desktop](example_img/homepage-desktop(with-credits).png?raw=true)

## To Use
Copy the config.sample.json file and rename to config.json. Be sure to update the fields as you see appropriate. You have the option to use the Unsplash API to fetch background images, or use a custom URL and JSON selector. If you choose to use Unsplash, will need to create a developer profile at [Unsplash](https://unsplash.com/) to use the background image functionality properly. 

## Configure Homepage
- 'items' => The menu will scale to the amount of items you want to display. Insert any link you'd like, or {{cur}} for the current URL of the page. Choose icons from [Font Awesome](http://fontawesome.io/icons/)

### Unsplash Background Images
- 'unsplash_client_id' => Get Unsplash client ID from [Unsplash](https://unsplash.com/developers) Leave this blank if you want to use Trianglify!
- 'credits' => Whether you want to give credits to the artists, or not.

### Custom Background Images
- 'custom_url' => Input a custom URL that will return proper JSON
- 'custom_url_headers' => Add any headers that may be needed to complete a cURL request to the aforementioned URL properly
- 'custom_url_selector' => Input a proper PHP array selector to be used on the JSON received above. For example, if I were to fetch from Github's user API with a 'custom_url' of 'https://api.github.com/users/octocat', the 'custom_url_selector' would simply be "['avatar_url']". [{random}] can be replaced for a random index in an array. 
