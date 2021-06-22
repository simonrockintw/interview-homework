# 新聞管理系統

### User Story
有大約 10 萬篇新聞文章需要給一般使用者瀏覽, 內部管理者會需要以下系統將手上已有的文章錄入新聞管理系統內

- 文章包含了以下內容 [標題], [作者], [公佈時間], [內文]
- 對於內部管理者需要可以針對文章新增/刪除/編輯/上下架等等的管理
- 對於一般使用者需要可以瀏覽已經上架的文章

### 其他條件
- 可以不需權限身份驗證功能
- 請分成二套程式碼分別是內部管理者使用和一般使用者瀏覽
- 顯示介面可以使用 bootstrap 或是任何想要使用的 css 框架, 或者自有皆可不限制
- 需要包含 SQL 檔案, 如果有使用 mirgrate tool, 請明確描述使用方式
- 作業繳交請自行 push 到 GitHub 上, 並通知 HR 人員協助後續流程
- 如果有使用 docker 請提供 docker-compose.xml 跟相關環境變數檔案, 方便部署驗證
- 沒有提到或者不在上列限制都可以自由發揮



### 網站說明
- 一般使用者瀏覽頁面 (可點擊新聞title進入內頁) http://[host]/
- 前台新聞超過10則後會做分頁處理
- 內部管理者頁面 http://[host]/backend/news

### 安裝說明
- clone 專案下來後
```
composer install
cp .env.example .env
sudo php artisan key:generate
sudo chown -R www-data:www-data .
sudo chmod -R 2770 ./storage/
mysql -uroot -p -hlocalhost  => 建DB
vi .env => 設定DB
php artisan migrate
```
