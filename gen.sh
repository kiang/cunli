# sudo apt-get install npm gdal-bin
# sudo npm install -g mapshaper
ogr2ogr -t_srs EPSG:4326 -s_srs EPSG:3826 -f "ESRI Shapefile" -lco ENCODING=UTF-8 3826.shp 全國村里界圖102.05.21_修正屬性表ID_TWD97/102_05_21台澎金馬修正村里屬性資料_TWD97.shp
# ogr2ogr -t_srs EPSG:4326 -s_srs EPSG:3825 -f "ESRI Shapefile" -lco ENCODING=UTF-8 3825.shp 全國村里界圖102.05.21_修正屬性表ID_TWD97/102_05_21台澎金馬修正村里屬性資料_TWD97.shp
mapshaper -p 0.01 3826.shp -f topojson --encoding utf8 -o 102_05_21_3826.json
# mapshaper -p 0.01 3825.shp -f topojson --encoding utf8 -o 102_05_21_3825.json
rm -f 3826.*
# rm -f 3825.*
