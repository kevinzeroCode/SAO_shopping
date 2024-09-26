import smtplib
import sys
# email =sys.argv[1]
email = 'david70825@gmail.com'
smtp=smtplib.SMTP('smtp.gmail.com', 587)
smtp.ehlo()
smtp.starttls()
smtp.login('starshoppingnoreply@gmail.com','E663E663')
from_addr='starshoppingnoreply@gmail.com'
to_addr=email
msg="Subject:註冊成功\n您已成功註冊帳號!"
status=smtp.sendmail(from_addr, to_addr, msg)
if status=={}:
    print("郵件傳送成功!")
else:
    print("郵件傳送失敗!")
smtp.quit()