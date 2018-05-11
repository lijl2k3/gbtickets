<?php

namespace app\common\validate;
use think\Validate;
class Info extends Validate
{
    protected $rule=[
        'member|Member Number'=>[
            'require',
            'alphaDash'=>'alphaDash',
        ],
        'f_name|First Name'=>[
            'require',
            'max'=>20,
            'chsAlpha'=>'chsAlpha',
        ],
        'l_name|Last Name'=>[
            'require'=>'require',
            'max'=>20,
            'chsAlpha'=>'chsAlpha',
        ],
        'company|Company Name'=>[
            'require'=>'require',
            'max'=>120,
        ],
        'email|Email'=>[
            'require'=>'require',
            'email'=>'email',
            'unique'=>'dinnerdance'
        ],
        'mobile|Mobile Phone Number'=>'mobile',
        'amount|Amount of Tickets'=>'integer',
        'fapiao_need'=>'boolean',
        'address_tickets|Ticket Mailing Address'=>[
            'require'=>'require',
        ],
        'address_fapiao|Invoice Mailing Address'=>[
            'requireIf:fapiao_need,1',
        ],
        'title_fapiao|Invoice Title'=>[
            'requireIf:fapiao_need,1',
        ],
        'taxnumber|Tax Number'=>[
            'requireIf:fapiao_need,1',
            'alphaNum'
            ]

    ];
}