sass default/assets/css/scss/main.scss:default/assets/css/main.css --style compressed
sed -i -e '/sourceMappingURL=main.css.map/d' default/assets/css/main.css
rm default/assets/css/main.css-e
rm default/assets/css/main.css.map
rm -rf .sass-cache