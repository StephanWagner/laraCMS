<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'Dieses Feld muss akzeptiert werden.',
    'accepted_if' => 'Dieses Feld muss akzeptiert werden wenn :other den Wert :value hat.',
    'active_url' => 'Dieses Feld muss eine gültige URL sein.',
    'after' => 'Dieses Feld muss ein Datum nach :date sein.',
    'after_or_equal' => 'Dieses Feld muss nach oder am :date sein.',
    'alpha' => 'Dieses Feld darf nur Buchstaben enthalten.',
    'alpha_dash' => 'Dieses Feld darf nur Buchstaben, Zahlen, Trennstriche und Unterstriche enthalten.',
    'alpha_num' => 'Dieses Feld darf nur Zahlen enthalten.',
    'array' => 'Dieses Feld muss ein Array sein.',

    // TODO!!!

    // 'ascii' => 'Dieses Feld muss only contain single-byte alphanumeric characters and symbols.',
    'before' => 'Dieses Feld muss ein Datum vor :date sein.',
    'before_or_equal' => 'Dieses Feld muss ein Datum vor oder am :date sein.',
    // 'between' => [
    //     'array' => 'Dieses Feld muss have between :min and :max items.',
    //     'file' => 'Dieses Feld muss be between :min and :max kilobytes.',
    //     'numeric' => 'Dieses Feld muss be between :min and :max.',
    //     'string' => 'Dieses Feld muss be between :min and :max characters.',
    // ],
    'boolean' => 'Dieses Feld muss wahr oder falsch sein.',
    'confirmed' => 'Diese Feldbestätigung stimmt nicht überein.',
    'current_password' => 'Das Passwort ist inkorrekt.',
    'date' => 'Dieses Feld is not a valid date.',
    'date_equals' => 'Dieses Feld muss ein Datum gleich :date sein.',
    'date_format' => 'Dieses Feld stimmt dem Format :format nicht überein.',
    'decimal' => 'Dieses Feld muss :decimal Dezimalstellen haben.',
    'declined' => 'Dieses Feld muss abgelehnt werden.',
    'declined_if' => 'Dieses Feld muss abgelehnt werden wenn :other den Wert :value hat.',
    'different' => 'Dieses Feld und :other müssen unterschiedlich sein.',
    'digits' => 'Dieses Feld muss :digits Ziffern enthalten.',
    'digits_between' => 'Dieses Feld muss zwischen :min und :max Ziffern enthalten.',
    'dimensions' => 'Dieses Feld hat ungültige Bildabmessungen.',
    'distinct' => 'Dieses Feld hat einen doppelten Wert.',
    'doesnt_end_with' => 'Dieses Feld darf nicht mit einem der folgenden Werte enden: :values.',
    'doesnt_start_with' => 'Dieses Feld darf nicht mit einem der folgenden Werte starten: :values.',
    'email' => 'Dieses Feld muss eine gültige E-Mail Adresse sein.',
    'ends_with' => 'Dieses Feld muss mit einem der folgenden Werte enden: :values.',
    // 'enum' => 'The selected :attribute is invalid.',
    // 'exists' => 'The selected :attribute is invalid.',
    'file' => 'Dieses Feld muss eine Datei sein.',
    'filled' => 'Dieses Feld muss einen Wert haben.',
    // 'gt' => [
    //     'array' => 'Dieses Feld muss have more than :value items.',
    //     'file' => 'Dieses Feld muss be greater than :value kilobytes.',
    //     'numeric' => 'Dieses Feld muss be greater than :value.',
    //     'string' => 'Dieses Feld muss be greater than :value characters.',
    // ],
    // 'gte' => [
    //     'array' => 'Dieses Feld muss have :value items or more.',
    //     'file' => 'Dieses Feld muss be greater than or equal to :value kilobytes.',
    //     'numeric' => 'Dieses Feld muss be greater than or equal to :value.',
    //     'string' => 'Dieses Feld muss be greater than or equal to :value characters.',
    // ],
    // 'image' => 'Dieses Feld muss be an image.',
    // 'in' => 'The selected field is invalid.',
    // 'in_array' => 'Dieses Feld does not exist in :other.',
    // 'integer' => 'Dieses Feld muss be an integer.',
    'ip' => 'Dieses Feld muss eine gültige IP Adresse sein.',
    'ipv4' => 'Dieses Feld muss eine gültige IPv4 Adresse sein.',
    'ipv6' => 'Dieses Feld muss eine gültige IPv6 Adresse sein.',
    'json' => 'Dieses Feld muss ein gültiger JSON-String sein.',
    'lowercase' => 'Dieses Feld darf nur Kleinbuchstaben enthalten.',
    // 'lt' => [
    //     'array' => 'Dieses Feld muss have less than :value items.',
    //     'file' => 'Dieses Feld muss be less than :value kilobytes.',
    //     'numeric' => 'Dieses Feld muss be less than :value.',
    //     'string' => 'Dieses Feld muss be less than :value characters.',
    // ],
    // 'lte' => [
    //     'array' => 'Dieses Feld muss not have more than :value items.',
    //     'file' => 'Dieses Feld muss be less than or equal to :value kilobytes.',
    //     'numeric' => 'Dieses Feld muss be less than or equal to :value.',
    //     'string' => 'Dieses Feld muss be less than or equal to :value characters.',
    // ],
    // 'mac_address' => 'Dieses Feld muss be a valid MAC address.',
    // 'max' => [
    //     'array' => 'Dieses Feld muss not have more than :max items.',
    //     'file' => 'Dieses Feld muss not be greater than :max kilobytes.',
    //     'numeric' => 'Dieses Feld muss not be greater than :max.',
    //     'string' => 'Dieses Feld muss not be greater than :max characters.',
    // ],
    // 'max_digits' => 'Dieses Feld muss not have more than :max digits.',
    'mimes' => 'Dieses Feld muss folgenden Dateityp haben: :values.',
    'mimetypes' => 'Dieses Feld muss folgenden Dateityp haben: :values.',
    // 'min' => [
    //     'array' => 'Dieses Feld muss have at least :min items.',
    //     'file' => 'Dieses Feld muss be at least :min kilobytes.',
    //     'numeric' => 'Dieses Feld muss be at least :min.',
    //     'string' => 'Dieses Feld muss be at least :min characters.',
    // ],
    // 'min_digits' => 'Dieses Feld muss have at least :min digits.',
    // 'multiple_of' => 'Dieses Feld muss be a multiple of :value.',
    // 'not_in' => 'The selected field is invalid.',
    'not_regex' => 'Dieses Feld hat eine ungültige Formatierung.',
    'numeric' => 'Dieses Feld muss eine Nummer sein.',
    // 'password' => [
    //     'letters' => 'The password must contain at least one letter.',
    //     'mixed' => 'The password must contain at least one uppercase and one lowercase letter.',
    //     'numbers' => 'The password must contain at least one number.',
    //     'symbols' => 'The password must contain at least one symbol.',
    //     'uncompromised' => 'The given password has appeared in a data leak. Please choose a different one.',
    // ],
    'present' => 'Dieses Feld muss vorhanden sein.',
    'prohibited' => 'Dieses Feld ist verboten.',
    'prohibited_if' => 'Dieses Feld ist verboten wenn :other den Wert :value hat.',
    'prohibited_unless' => 'Dieses Feld ist verboten es sei denn :other hat einen folgender Werte: :values.',
    'prohibits' => 'Dieses Feld verbietet :other vorhanden zu sein.',
    'regex' => 'Dieses Feld hat eine ungültige Formatierung.',
    'required' => 'Dieses Feld wird benötigt.',
    // 'required_array_keys' => 'Dieses Feld muss contain entries for: :values.',
    // 'required_if' => 'Dieses Feld is required when :other is :value.',
    // 'required_if_accepted' => 'Dieses Feld is required when :other is accepted.',
    // 'required_unless' => 'Dieses Feld is required unless :other is in :values.',
    // 'required_with' => 'Dieses Feld is required when :values is present.',
    // 'required_with_all' => 'Dieses Feld is required when :values are present.',
    // 'required_without' => 'Dieses Feld is required when :values is not present.',
    // 'required_without_all' => 'Dieses Feld is required when none of :values are present.',
    // 'same' => 'Dieses Feld and :other must match.',
    // 'size' => [
    //     'array' => 'Dieses Feld muss contain :size items.',
    //     'file' => 'Dieses Feld muss be :size kilobytes.',
    //     'numeric' => 'Dieses Feld muss be :size.',
    //     'string' => 'Dieses Feld muss be :size characters.',
    // ],
    // 'starts_with' => 'Dieses Feld muss start with one of the following: :values.',
    // 'string' => 'Dieses Feld muss be a string.',
    // 'timezone' => 'Dieses Feld muss be a valid timezone.',
    // 'unique' => 'Dieses Feld has already been taken.',
    // 'uploaded' => 'Dieses Feld failed to upload.',
    'uppercase' => 'Dieses Feld darf nur Großbuchstaben enthalten.',
    'url' => 'Dieses Feld muss eine gültige URL sein.',
    'ulid' => 'Dieses Feld muss eine gültige ULID sein.',
    'uuid' => 'Dieses Feld muss eine gültige UUID sein.',

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
