# sudo apt-get install npm gdal-bin
# sudo npm install -g mapshaper

# convert shp to geojson & big5 to utf8
mapshaper -p 0.01 --auto-snap -f geojson --encoding big5 -o json/103_05_01_twd97.geo.json shp/1030501/103_05_01台灣村里界\(含離島\)_TWD97_121.shp

# convert geojson polygons from EPSG:3826 to EPSG:4326
ogr2ogr -t_srs EPSG:4326 -s_srs EPSG:3826 -f "GeoJSON" -lco ENCODING=UTF-8 json/103_05_01_4326.geo.json json/103_05_01_twd97.geo.json

# convert geojson to topojson
mapshaper -p 0.01 --auto-snap -f topojson --encoding utf8 -o json/103_05_01_4326.topo.json json/103_05_01_4326.geo.json