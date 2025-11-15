<?php

return [

    /*
    |--------------------------------------------------------------------------
    | バリデーション言語行
    |--------------------------------------------------------------------------
    */

    'accepted'             => ':attribute を承認してください。',
    'active_url'           => ':attribute は有効なURLではありません。',
    'after'                => ':attribute には :date 以降の日付を指定してください。',
    'after_or_equal'       => ':attribute には :date 以降または同日の日付を指定してください。',
    'alpha'                => ':attribute は英字のみで入力してください。',
    'alpha_dash'           => ':attribute は英数字、ハイフン、アンダースコアのみ使用できます。',
    'alpha_num'            => ':attribute は英数字のみで入力してください。',
    'array'                => ':attribute は配列でなければなりません。',
    'before'               => ':attribute には :date 以前の日付を指定してください。',
    'before_or_equal'      => ':attribute には :date 以前または同日の日付を指定してください。',
    'between'              => [
        'numeric' => ':attribute は :min ～ :max の間で指定してください。',
        'file'    => ':attribute は :min ～ :max KBの間で指定してください。',
        'string'  => ':attribute は :min ～ :max 文字の間で指定してください。',
        'array'   => ':attribute の項目は :min ～ :max 個でなければなりません。',
    ],
    'boolean'              => ':attribute は true か false を指定してください。',
    'confirmed'            => ':attribute の確認が一致しません。',
    'current_password'     => 'パスワードが正しくありません。',
    'date'                 => ':attribute は有効な日付ではありません。',
    'date_equals'          => ':attribute には :date と同じ日付を指定してください。',
    'date_format'          => ':attribute は :format 形式と一致しません。',
    'different'            => ':attribute と :other には異なる値を指定してください。',
    'digits'               => ':attribute は :digits 桁でなければなりません。',
    'digits_between'       => ':attribute は :min ～ :max 桁の間で指定してください。',
    'email'                => ':attribute には有効なメールアドレスを指定してください。',
    'ends_with'            => ':attribute は次のいずれかで終了してください: :values。',
    'exists'               => '選択された :attribute は無効です。',
    'file'                 => ':attribute はファイルでなければなりません。',
    'filled'               => ':attribute は必須です。',
    'gt' => [
        'numeric' => ':attribute は :value より大きくなければなりません。',
        'file'    => ':attribute は :value KBより大きくなければなりません。',
        'string'  => ':attribute は :value 文字より多くなければなりません。',
        'array'   => ':attribute の項目数は :value より多くなければなりません。',
    ],
    'gte' => [
        'numeric' => ':attribute は :value 以上でなければなりません。',
        'file'    => ':attribute は :value KB以上でなければなりません。',
        'string'  => ':attribute は :value 文字以上でなければなりません。',
        'array'   => ':attribute の項目数は :value 以上でなければなりません。',
    ],
    'image'                => ':attribute は画像でなければなりません。',
    'in'                   => '選択された :attribute は無効です。',
    'integer'              => ':attribute は整数でなければなりません。',
    'ip'                   => ':attribute は有効なIPアドレスを指定してください。',
    'ipv4'                 => ':attribute は有効なIPv4アドレスを指定してください。',
    'ipv6'                 => ':attribute は有効なIPv6アドレスを指定してください。',
    'json'                 => ':attribute は正しいJSON形式でなければなりません。',
    'lt' => [
        'numeric' => ':attribute は :value 未満でなければなりません。',
        'file'    => ':attribute は :value KB未満でなければなりません。',
        'string'  => ':attribute は :value 文字未満でなければなりません。',
        'array'   => ':attribute の項目数は :value 未満でなければなりません。',
    ],
    'lte' => [
        'numeric' => ':attribute は :value 以下でなければなりません。',
        'file'    => ':attribute は :value KB以下でなければなりません。',
        'string'  => ':attribute は :value 文字以下でなければなりません。',
        'array'   => ':attribute の項目数は :value 以下でなければなりません。',
    ],
    'max' => [
        'numeric' => ':attribute は :max 以下でなければなりません。',
        'file'    => ':attribute は :max KB以下でなければなりません。',
        'string'  => ':attribute は :max 文字以下でなければなりません。',
        'array'   => ':attribute の項目数は :max 以下でなければなりません。',
    ],
    'mimes'                => ':attribute には次のファイルタイプを指定してください: :values。',
    'mimetypes'            => ':attribute には次のファイルタイプを指定してください: :values。',
    'min' => [
        'numeric' => ':attribute は少なくとも :min でなければなりません。',
        'file'    => ':attribute は少なくとも :min KBでなければなりません。',
        'string'  => ':attribute は少なくとも :min 文字でなければなりません。',
        'array'   => ':attribute の項目数は少なくとも :min 個でなければなりません。',
    ],
    'multiple_of'          => ':attribute は :value の倍数でなければなりません。',
    'not_in'               => '選択された :attribute は無効です。',
    'not_regex'            => ':attribute の形式が無効です。',
    'numeric'              => ':attribute は数値でなければなりません。',
    'present'              => ':attribute は必須です。',
    'regex'                => ':attribute の形式が無効です。',
    'required'             => ':attribute は必須です。',
    'required_if'          => ':other が :value の場合、:attribute は必須です。',
    'required_unless'      => ':other が :values に含まれない場合、:attribute は必須です。',
    'required_with'        => ':values が存在する場合、:attribute は必須です。',
    'required_with_all'    => ':values がすべて存在する場合、:attribute は必須です。',
    'required_without'     => ':values が存在しない場合、:attribute は必須です。',
    'required_without_all' => ':values がすべて存在しない場合、:attribute は必須です。',
    'same'                 => ':attribute と :other が一致していません。',
    'size' => [
        'numeric' => ':attribute は :size でなければなりません。',
        'file'    => ':attribute は :size KBでなければなりません。',
        'string'  => ':attribute は :size 文字でなければなりません。',
        'array'   => ':attribute の項目数は :size 個でなければなりません。',
    ],
    'starts_with'          => ':attribute は次のいずれかで始まらなければなりません: :values。',
    'string'               => ':attribute は文字列でなければなりません。',
    'timezone'             => ':attribute は有効なタイムゾーンでなければなりません。',
    'unique'               => ':attribute はすでに使用されています。',
    'uploaded'             => ':attribute のアップロードに失敗しました。',
    'url'                  => ':attribute は有効なURL形式で指定してください。',
    'uuid'                 => ':attribute は有効なUUIDでなければなりません。',

    /*
    |--------------------------------------------------------------------------
    | カスタムバリデーション属性名
    |--------------------------------------------------------------------------
    */
    'attributes' => [],
];
