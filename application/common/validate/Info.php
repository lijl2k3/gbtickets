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
        'mobile|Mobile Phone Number'=>'require|mobile',
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

    protected $scene=[
        'edit'=>['member|Member Number',
            'f_name|First Name',
            'l_name|last Name',
            'company|Company Name',
            'mobile|Mobile Phone Number',
            'amount|Amount of Tickets',
            'fapiao_need',
            'address_tickets|Ticket Mailing Address',
            'address_fapiao|Invoice Mailing Address',
            'title_fapiao|Invoice Title',
            'taxnumber|Tax Number'
        ]
    ];
}