<%
'servstr="DSN=ADMInterDocs;UID=sa;PWD=;"
servstr="driver={SQL Server};server=ICC_NOTEBOOK\SQLEXPRESS;UID=sa;PWD=sa;database=ADMInterDocs;"
baseurl="http://"&request.servervariables("SERVER_NAME")&"/"

Function format_date(date_string,date_template)
    Dim weekdays_array,months_array,ofmonths_array,date_value,time_value
    weekdays_array=Split("�����������,�������,�����,�������,�������,�������,�����������",",")
    months_array=Split("������,�������,����,������,���,����,����,������,��������,�������,������,�������",",")
    ofmonths_array=Split("������,�������,�����,������,���,����,����,�������,��������,�������,������,�������",",")
    date_value=DateValue(date_string)
    time_value=TimeValue(date_string)
    format_date=Replace(Replace(Replace(Replace(date_template,"%day",weekdays_array(Weekday(date_value,vbMonday)-1)),"%month",months_array(Month(date_value)-1)),"%ofmonth",ofmonths_array(Month(date_value)-1)),"%mon",Left(months_array(Month(date_value)-1),3))
    format_date=Replace(Replace(Replace(Replace(format_date,"%hh",Right("0" & Hour(time_value),2)),"%h",Hour(time_value)),"%mi",Right("0" & Minute(time_value),2)),"%s",Right("0" & Second(time_value),2))
    format_date=Replace(Replace(Replace(Replace(Replace(Replace(format_date,"%yyyy",Year(date_value)),"%yy",Right(Year(date_value),2)),"%dd",Right("0"&Day(date_value),2)),"%d",Day(date_value)),"%mm",Right("0"&Month(date_value),2)),"%m",Month(date_value))
End Function

%>