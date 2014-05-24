<?php
// Arabic language strings constants.
define('DEVELOPED_BY', 'Developed By');
define('GEORGE', 'George Trad');
define('MOHAMMAD', 'Mohammad Haddad');
define('TITLE', 'الإرشاد الأكاديمي');
define('LOGIN', 'تسجيل الدخول');
define('USERNAME', 'اسم المستخدم');
define('PASSWORD', 'كلمة المرور');
define('INVALID_LOGIN', 'يرجى إدخال معلومات تسجيل الدخول');
define('INVALID_CRED', 'معلومات تسجيل الدخول غير صحيحة');
define('WELCOME', 'مرحباً');
define('LOGOUT', 'تسجيل الخروج');

define('HOME', 'الرئيسية');
    define('CURRENT_SEMESTER', 'الفصل الحالي');
    define('NUM_SUGG_CRS', 'عدد المواد المقترحة');
    define('NUM_BELOW_STU', 'عدد الطلاب دون النصاب');
    define('NUM_STU_WITHOUT_ADV', 'عدد الطلاب بدون مرشد أكاديمي');
    define('MOST_FAILED_CRS', 'المادة الأكثر رسوباً');
    define('MOST_PASSED_CRS', 'المادة الأكثر نجاحاً');    

define('SEMESTERS', 'الفصول');
    define('PREV_SEMESTERS', 'الفصول السابقة');
    define('NEW_SEMESTER', 'فصل جديد');
    define('START_DATE', 'تاريخ البدء');
    define('END_DATE', 'تاريخ الانتهاء');
    define('MIN_REQ_HRS', 'عدد الساعات الأدنى');
    define('MAX_REQ_HRS', 'عدد الساعات الأعلى');
    define('EXC_GPA', 'المعدل المستثنى');
    define('EXC_GPA_HRS', 'عدد ساعاته');
    define('MAX_GRAD_STU_HRS', 'ساعات طالب التخرج');

define('COURSES', 'المقررات');    
    define('SUGGEST_COURSES', 'اقتراح مقررات');
        define('AFFECTED_STU', 'الطلاب الذين لم يحققوا عدد الساعات الأدنى');
        define('COURSE_CODE', 'رمز المقرر');
        define('COURSE_NAME', 'اسم المقرر');
        define('COURSE_TYPE', 'نوع المقرر');
        define('LEVEL', 'المستوى');
        define('REQ_COURSE', 'المتطلب السابق');
        define('CREDITS', 'الساعات المعتمدة');
        define('CLASS_HRS', 'ساعات النظري');
        define('LAB_HRS', 'ساعات العملي');
        define('FEES', 'الرسوم');
        define('NEVER_ADDED', 'لم تُضف من قبل');
        define('ADDED', 'أُضيفت');
        define('REMOVED', 'حُذفت');
        define('CLASS_A', 'ضمن/أعلى - راسبون');
        define('CLASS_B', 'أدنى بمستوى واحد');
        define('CLASS_C', 'راسبون في المتطلب السابق');        
        
    define('SUGGESTED_COURSES', 'المقررات المقترحة');
    
define('STUDENTS', 'الطلاب');
    define('ALL_STUDENTS', 'طلاب الكلية');
        define('SEARCH_TYPE', 'نوع البحث');
        define('STUDENTS_TABLE', 'جدول الطلاب');
            define('COLLEGE_ID', 'الرقم الجامعي');
            define('NAME', 'الاسم');
            define('MIDDLE_NAME', 'اسم الأب');
            define('LAST_NAME', 'النسبة');
            define('GENDER', 'الجنس');
            define('BIRTH_DATE', 'تاريخ الميلاد');
            define('NATIONAL_ID', 'الرقم الوطني');
            define('EMAIL', 'البريد الالكتروني');
            define('ADDRESS', 'العنوان');
            define('FINAL_GRADE', 'الدرجة النهائية');
    
define('TEACHERS', 'المدرسون');
    define('DEP', 'القسم');
    define('DEGREE', 'المرتبة العلمية');
        define('DOCTOR', 'دكتور');
        define('ENGINEER', 'مهندس');
    
define('ACADEMIC_ADVISING', 'الارشاد الأكاديمي');
    define('ASSIGN_STUDENTS', 'إسناد طلاب');
        define('ADVISOR', 'المرشد الحالي');
        define('STU_NAME', 'اسم الطالب');
    define('ADVISE', 'إرشاد طالب');
        define('PERSONAL_INFO', 'المعلومات الشخصية');
        define('ACADEMIC_INFO', 'المعلومات الأكاديمية');
        define('AVAILABLE_CRS', 'المقررات المتاحة');
        define('ADVISE_SEARCH_ERROR', 'لا يمكنك رؤية معلومات هذا الطالب');
        define('ENTER_STU_ID', 'الرجاء إدخال الرقم الجامعي للطالب');
        define('COMPLETED_HRS', 'عدد الساعات المنجزة');
        define('GPA', 'المعدل النقطي');        
        define('FAILED_CRS_NUM', 'عدد المواد الراسبة');        
        define('REG_DATE', 'تاريخ التسجيل');
        define('DEP_HRS', 'ساعات القسم');

define('IMPORTING', 'الاستيراد');
    define('IMPORT_FILES', 'استيراد ملفات');
    define('UPLOAD_FILE', 'رفع ملف');
        define('UPLOAD', 'رفع');
        define('SEMESRER', 'الفصل الدراسي');
        define('PICK_SEMESTER', 'اختر الفصل');
        define('IMP_STU', 'طلاب');
        define('IMP_COURSES', 'مقررات');
        define('IMP_CLASSES', 'شعب');
        define('IMP_FIN_GRADE', 'علامات نهائية');    
        define('IMP_COURSE_FILE', 'ملف مقررات');
        define('IMP_STUDENT_FILE', 'ملف طلاب');
        define('IMPORT', 'استيراد');
        define('INSERT_SUCCESS', 'تمّ استيراد البيانات بنجاح');
    define('UPDATE_DATA', 'تحديث بيانات');
        define('UPDATE_STU', 'تحديث عدد الساعات المنجزة ومستوى الطلاب');
        define('UPDATE_RELATION', 'تحديث مواد الطلاب');
        define('UPDATE_SUCCESS', 'تمّ تحديث البيانات بنجاح');
        define('UPDATE_STU_NUM', 'تحديث عدد الطلاب في كل مقرر');
    
define('SETTINGS', 'الاعدادات');
    define('GRADES_DIST', 'توزيع الدرجات والنقاط');
        define('GRADES', 'الدرجات');
        define('GRADE_FROM', 'الحد الأدنى');
        define('APPLIES_TO', 'تطبق على طلاب عام');
        define('POINTS', 'النقاط');
        define('LETTER', 'التقدير');
        
    define('HRS_CONST', 'ثوابت ساعات المستويات');
        define('LEVELS_DIST', 'توزيع المستويات');
        define('NUM_COMP_HRS', 'عدد الساعات المنجزة');
        define('LEVEL_2', 'الثاني');
        define('LEVEL_3', 'الثالث');
        define('LEVEL_4', 'الرابع');
        define('LEVEL_5', 'الخامس');
    
define('DB', 'قاعدة البيانات');

define('SEARCH', 'بحث');
define('FILENAME', 'اسم الملف');
define('BROWSE', 'إستعراض');
define('PHONE_NUM', 'رقم الهاتف');

define('STUDENT_GRADE', 'كشف علامات الطالب');
define('ARABIC', 'عربي');
define('ENGLISH', 'إنكليزي');
define('SAVE', 'حفظ');
define('DELETE', 'حذف');
define('CHOOSE_OPTION', 'اختر أحد الخيارات');
define('UPDATE', 'تحديث');
define('MALE', 'ذكر');
define('FEMALE', 'أنثى');
?>
