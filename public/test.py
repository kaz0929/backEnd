from selenium import webdriver
from bs4 import BeautifulSoup
import time
import json

chrome_path = "C:/Users/user/Downloads/chromedriver_win32/chromedriver.exe" #chromedriver.exe執行檔所存在的路徑
web = webdriver.Chrome(chrome_path)


#https://silently0801.github.io/Silently/WeatherApi/

web.get('https://silently0801.github.io/Silently/WeatherApi/')
web.set_window_position(0,0) #瀏覽器位置
web.set_window_size(700,700) #瀏覽器大小
time.sleep(2)

soup = BeautifulSoup(web.page_source, "html.parser")
all_location = soup.select('h1.location')

location_list = []

for location in all_location:
    location_list.append(location.text)

location_json = json.dumps(location_list)
print(location_json)

web.quit()
