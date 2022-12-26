Config database mysql:

B1: Mở file C:\XAMPP\mysql\bin\my.ini
B2: Tìm chuỗi C:/xampp/mysql/data chuỗi này thường xuất hiện ở các dòng: 
	- 33:datadir 
	- 139:innodb_data_home_dir
	- 141:innodb_log_group_home_dir
B3: Sửa lại thành đường dẫn C:/xampp/htdocs/Website/data
