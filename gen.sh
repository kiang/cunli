# sudo apt-get install npm gdal-bin
# sudo npm install -g mapshaper

# convert shp to geojson & big5 to utf8
mapshaper -p 0.01 --auto-snap -f geojson --encoding big5 -o json/102_05_21_twd97.geo.json 全國村里界圖102.05.21_修正屬性表ID_TWD97/102_05_21台澎金馬修正村里屬性資料_TWD97.shp

# convert geojson polygons from EPSG:3826 to EPSG:4326
ogr2ogr -t_srs EPSG:4326 -s_srs EPSG:3826 -f "GeoJSON" -lco ENCODING=UTF-8 json/102_05_21_4326.geo.json json/102_05_21_twd97.geo.json

# convert geojson to topojson
mapshaper -p 0.01 --auto-snap -f topojson --encoding utf8 -o json/102_05_21_4326.topo.json json/102_05_21_4326.geo.json