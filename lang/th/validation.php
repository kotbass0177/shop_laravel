
<?php

return [

  /*
    |--------------------------------------------------------------------------
    | Validation Language Lines (Thai)
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

  'accepted' => ':attribute ต้องยอมรับ',
  'accepted_if' => ':attribute ต้องยอมรับเมื่อ :other เป็น :value',
  'active_url' => ':attribute ต้องเป็น URL ที่ถูกต้อง',
  'after' => ':attribute ต้องเป็นวันที่หลังจาก :date',
  'after_or_equal' => ':attribute ต้องเป็นวันที่หลังจากหรือเท่ากับ :date',
  'alpha' => ':attribute ต้องประกอบด้วยตัวอักษรเท่านั้น',
  'alpha_dash' => ':attribute ต้องประกอบด้วยตัวอักษร ตัวเลข เครื่องหมายขีด (-) และเครื่องหมายขีดล่าง (_) เท่านั้น',
  'alpha_num' => ':attribute ต้องประกอบด้วยตัวอักษรและตัวเลขเท่านั้น',
  'array' => ':attribute ต้องเป็นอาร์เรย์',
  'ascii' => ':attribute ต้องประกอบด้วยอักขระ alphanumeric และสัญลักษณ์แบบ single-byte เท่านั้น',
  'before' => ':attribute ต้องเป็นวันที่ก่อน :date',
  'before_or_equal' => ':attribute ต้องเป็นวันที่ก่อนหรือเท่ากับ :date',
  'between' => [
    'array' => ':attribute ต้องมีระหว่าง :min ถึง :max รายการ',
    'file' => ':attribute ต้องมีขนาดระหว่าง :min ถึง :max กิโลไบต์',
    'numeric' => ':attribute ต้องมีค่าระหว่าง :min ถึง :max',
    'string' => ':attribute ต้องมีความยาวระหว่าง :min ถึง :max ตัวอักษร',
  ],
  'boolean' => ':attribute ต้องเป็น true หรือ false',
  'can' => ':attribute มีค่าที่ไม่ได้รับอนุญาต',
  'confirmed' => 'การยืนยัน :attribute ไม่ตรงกัน',
  'current_password' => 'รหัสผ่านไม่ถูกต้อง',
  'date' => ':attribute ต้องเป็นวันที่ที่ถูกต้อง',
  'date_equals' => ':attribute ต้องเป็นวันที่เท่ากับ :date',
  'date_format' => ':attribute ต้องตรงกับรูปแบบ :format',
  'decimal' => ':attribute ต้องมี :decimal ตำแหน่งทศนิยม',
  'declined' => ':attribute ต้องปฏิเสธ',
  'declined_if' => ':attribute ต้องปฏิเสธเมื่อ :other เป็น :value',
  'different' => ':attribute และ :other ต้องไม่เหมือนกัน',
  'digits' => ':attribute ต้องเป็น :digits หลัก',
  'digits_between' => ':attribute ต้องอยู่ระหว่าง :min ถึง :max หลัก',
  'dimensions' => ':attribute มีขนาดภาพที่ไม่ถูกต้อง',
  'distinct' => ':attribute มีค่าที่ซ้ำกัน',
  'doesnt_end_with' => ':attribute ต้องไม่ลงท้ายด้วย: :values',
  'doesnt_start_with' => ':attribute ต้องไม่ขึ้นต้นด้วย: :values',
  'email' => ':attribute ต้องเป็นที่อยู่อีเมลที่ถูกต้อง',
  'ends_with' => ':attribute ต้องลงท้ายด้วย: :values',
  'enum' => ':attribute ที่เลือกไม่ถูกต้อง',
  'exists' => ':attribute ที่เลือกไม่ถูกต้อง',
  'extensions' => ':attribute ต้องเป็นไฟล์ที่มีนามสกุลดังต่อไปนี้: :values',
  'file' => ':attribute ต้องเป็นไฟล์',
  'filled' => ':attribute ต้องมีค่า',
  'gt' => [
    'array' => ':attribute ต้องมีมากกว่า :value รายการ',
    'file' => ':attribute ต้องมีขนาดมากกว่า :value กิโลไบต์',
    'numeric' => ':attribute ต้องมากกว่า :value',
    'string' => ':attribute ต้องยาวกว่า :value ตัวอักษร',
  ],
  'gte' => [
    'array' => ':attribute ต้องมีรายการอย่างน้อย :value รายการขึ้นไป',
    'file' => ':attribute ต้องมีขนาดมากกว่าหรือเท่ากับ :value กิโลไบต์',
    'numeric' => ':attribute ต้องมากกว่าหรือเท่ากับ :value',
    'string' => ':attribute ต้องมีความยาวอย่างน้อย :value ตัวอักษร',
  ],
  'hex_color' => ':attribute ต้องเป็นรหัสสี Hex ที่ถูกต้อง',
  'image' => ':attribute ต้องเป็นไฟล์รูปภาพ',
  'in' => ':attribute ที่เลือกไม่ถูกต้อง',
  'in_array' => ':attribute จะต้องเป็นหนึ่งในค่าของ :other',
  'integer' => ':attribute ต้องเป็นตัวเลขเต็ม',
  'ip' => ':attribute ต้องเป็นที่อยู่ IP ที่ถูกต้อง',
  'ipv4' => ':attribute ต้องเป็นที่อยู่ IPv4 ที่ถูกต้อง',
  'ipv6' => ':attribute ต้องเป็นที่อยู่ IPv6 ที่ถูกต้อง',
  'json' => ':attribute ต้องเป็นข้อความ JSON ที่ถูกต้อง',
  'lowercase' => ':attribute ต้องเป็นตัวอักษรเล็กทั้งหมด',
  'lt' => [
    'array' => ':attribute ต้องมีน้อยกว่า :value รายการ',
    'file' => ':attribute ต้องมีขนาดน้อยกว่า :value กิโลไบต์',
    'numeric' => ':attribute ต้องน้อยกว่า :value',
    'string' => ':attribute ต้องมีความยาวน้อยกว่า :value ตัวอักษร',
  ],
  'lte' => [
    'array' => ':attribute ต้องมีไม่เกิน :value รายการ',
    'file' => ':attribute ต้องมีขนาดไม่เกิน :value กิโลไบต์',
    'numeric' => ':attribute ต้องน้อยกว่าหรือเท่ากับ :value',
    'string' => ':attribute ต้องมีความยาวไม่เกิน :value ตัวอักษร',
  ],
  'mac_address' => ':attribute ต้องเป็นที่อยู่ MAC ที่ถูกต้อง',

  'max' => [
    'array' => ':attribute ต้องมีไม่เกิน :max รายการ',
    'file' => ':attribute ต้องมีขนาดไม่เกิน :max กิโลไบต์',
    'numeric' => ':attribute ต้องไม่เกิน :max',
    'string' => ':attribute ต้องมีความยาวไม่เกิน :max ตัวอักษร',
  ],

  'max_digits' => ':attribute ต้องมีไม่เกิน :max หลัก',

  'mimes' => ':attribute ต้องเป็นไฟล์ประเภท: :values',

  'mimetypes' => ':attribute ต้องเป็นไฟล์ประเภท: :values',

  'min' => [
    'array' => ':attribute ต้องมีอย่างน้อย :min รายการ',
    'file' => ':attribute ต้องมีขนาดอย่างน้อย :min กิโลไบต์',
    'numeric' => ':attribute ต้องอย่างน้อย :min',
    'string' => ':attribute ต้องมีความยาวอย่างน้อย :min ตัวอักษร',
  ],

  'min_digits' => ':attribute ต้องมีอย่างน้อย :min หลัก',

  'missing' => ':attribute ต้องว่างเปล่า',

  'missing_if' => 'เมื่อ :other มีค่าเป็น :value, :attribute ต้องว่างเปล่า',

  'missing_unless' => 'เมื่อ :other ไม่มีค่าเป็น :value, :attribute ต้องว่างเปล่า',

  'missing_with' => 'เมื่อ :values มีค่า, :attribute ต้องว่างเปล่า',

  'missing_with_all' => 'เมื่อ :values มีค่า, :attribute ต้องว่างเปล่า',

  'multiple_of' => ':attribute ต้องเป็นค่าที่หารด้วย :value ลงตัว',

  'not_in' => ':attribute ที่เลือกไม่ถูกต้อง',

  'not_regex' => 'รูปแบบของ :attribute ไม่ถูกต้อง',

  'numeric' => ':attribute ต้องเป็นตัวเลข',

  'password' => [
    'letters' => ':attribute ต้องประกอบด้วยตัวอักษรอย่างน้อย 1 ตัว',
    'mixed' => ':attribute ต้องประกอบด้วยตัวอักษรพิมพ์เล็ก 1 ตัว ตัวอักษรพิมพ์ใหญ่ 1 ตัว',
    'numbers' => ':attribute ต้องประกอบด้วยตัวเลขอย่างน้อย 1 ตัว',
    'symbols' => ':attribute ต้องประกอบด้วยสัญลักษณ์อย่างน้อย 1 ตัว',
    'uncompromised' => ':attribute ที่ระบุ มีอยู่ในข้อมูลรั่วไหล กรุณาเลือก :attribute ใหม่',
  ],
  'present' => ':attribute ต้องมีค่า',

  'present_if' => 'เมื่อ :other มีค่าเป็น :value, :attribute ต้องมีค่า',

  'present_unless' => 'เมื่อ :other ไม่มีค่าเป็น :value, :attribute ต้องมีค่า',

  'present_with' => 'เมื่อ :values มีค่า, :attribute ต้องมีค่า',

  'present_with_all' => 'เมื่อ :values มีค่า, :attribute ต้องมีค่า',

  'prohibited' => ':attribute ห้ามมีค่า',

  'prohibited_if' => 'เมื่อ :other มีค่าเป็น :value, :attribute ห้ามมีค่า',

  'prohibited_unless' => 'เมื่อ :other ไม่มีค่าใน :values, :attribute ห้ามมีค่า',

  'prohibits' => ':attribute ห้ามให้ :other มีค่า',

  'regex' => 'รูปแบบของ :attribute ไม่ถูกต้อง',

  'required' => ':attribute จำเป็นต้องมีค่า',

  'required_array_keys' => ':attribute ต้องประกอบด้วยค่าสำหรับ: :values',

  'required_if' => 'เมื่อ :other มีค่าเป็น :value, :attribute จำเป็นต้องมีค่า',

  'required_if_accepted' => 'เมื่อ :other ยอมรับ, :attribute จำเป็นต้องมีค่า',

  'required_unless' => 'เมื่อ :other ไม่มีค่าใน :values, :attribute จำเป็นต้องมีค่า',

  'required_with' => 'เมื่อ :values มีค่า, :attribute จำเป็นต้องมีค่า',

  'required_with_all' => 'เมื่อ :values มีค่า, :attribute จำเป็นต้องมีค่า',

  'required_without' => 'เมื่อ :values ไม่มีค่า, :attribute จำเป็นต้องมีค่า',

  'required_without_all' => 'เมื่อ :values ไม่มีค่าใดๆ, :attribute จำเป็นต้องมีค่า',

  'same' => ':attribute ต้องตรงกับ :other',

  'size' => [
    'array' => ':attribute ต้องประกอบด้วย :size รายการ',
    'file' => ':attribute ต้องมีขนาด :size กิโลไบต์',
    'numeric' => ':attribute ต้องมีค่าเท่ากับ :size',
    'string' => ':attribute ต้องมีความยาว :size ตัวอักษร',
  ],

  'starts_with' => ':attribute ต้องขึ้นต้นด้วยอย่างใดอย่างหนึ่งดังต่อไปนี้: :values',

  'string' => ':attribute ต้องเป็นข้อความ',

  'timezone' => ':attribute ต้องเป็นเขตเวลาที่ถูกต้อง',

  'unique' => ':attribute นี้มีอยู่แล้ว',

  'uploaded' => 'ไม่สามารถอัปโหลด :attribute ได้',

  'uppercase' => ':attribute ต้องเป็นตัวอักษรพิมพ์ใหญ่ทั้งหมด',

  'url' => ':attribute ต้องเป็น URL ที่ถูกต้อง',

  'ulid' => ':attribute ต้องเป็น ULID ที่ถูกต้อง',

  'uuid' => ':attribute ต้องเป็น UUID ที่ถูกต้อง',
  /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

  'custom' => [
    'attribute-name' => [
      'rule-name' => 'custom-message',
    ],
  ],

  /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

  'attributes' => [],

];
