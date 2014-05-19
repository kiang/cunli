# sudo apt-get install npm gdal-bin
# sudo npm install -g mapshaper

# convert shp to geojson & big5 to utf8
mapshaper -p 0.01 --auto-snap 全國村里界圖102.05.21_修正屬性表ID_TWD97/102_05_21台澎金馬修正村里屬性資料_TWD97.shp -f geojson --encoding big5 -o 102_05_21_twd97.geo.json

# convert geojson polygons from EPSG:3826 to EPSG:4326
ogr2ogr -t_srs EPSG:4326 -s_srs EPSG:3826 -f "GeoJSON" -lco ENCODING=UTF-8 102_05_21_3826.geo.json 102_05_21_twd97.geo.json

# convert geojson to topojson
mapshaper -p 0.01 --auto-snap 102_05_21_3826.geo.json -f topojson --encoding utf8 -o 102_05_21_3826.topo.json