# php-dynamic-forms

### USAGE

```php
<?php
```

###OUTPUT
```json
{  
   "title":"My EXAMPLE FORM",
   "name":"form1",
   "fields":[  
      {  
         "value":"defaultmessage",
         "type":"TextArea",
         "name":"textArea1",
         "label":"Your Message",
         "validators":[  
            {  
               "pattern":"\/^[a-z]+$\/",
               "type":"Regex",
               "message":"error pattern"
            },
            {  
               "min":0,
               "max":30,
               "type":"StringLength",
               "message":"error length"
            },
            {  
               "type":"Required",
               "message":"error required"
            }
         ]
      },
      {  
         "value":"",
         "type":"Text",
         "name":"date",
         "label":"date of birth",
         "validators":[  
            {  
               "min":"1984-02-01 09:42:42",
               "max":"2001-02-01 09:42:42",
               "type":"Date",
               "message":"year error"
            },
            {  
               "type":"Required",
               "message":"date is required"
            },
            {  
               "pattern":"\/^[0-9]{4}-[0-9]{2}-[0-9]{2}$\/",
               "type":"Regex",
               "message":"pattern error"
            }
         ]
      },
      {  
         "value":"info@example.com",
         "type":"Text",
         "name":"text1",
         "label":"email",
         "validators":[  
            {  
               "type":"Email",
               "message":"error email"
            }
         ]
      },
      {  
         "values":{  
            "min":30,
            "max":60
         },
         "min":0,
         "max":100,
         "step":1,
         "type":"Range",
         "name":"range1",
         "label":"any range",
         "validators":[  
            {  
               "type":"Inclusion",
               "message":"data error"
            }
         ]
      },
      {  
         "values":[  
            {  
               "text":"any checkBox item label-0",
               "value":0,
               "checked":false
            },
            {  
               "text":"any checkBox item label-1",
               "value":1,
               "checked":false
            },
            {  
               "text":"any checkBox item label-2",
               "value":2,
               "checked":false
            },
            {  
               "text":"any checkBox item label-3",
               "value":3,
               "checked":false
            },
            {  
               "text":"any checkBox item label-4",
               "value":4,
               "checked":false
            }
         ],
         "type":"CheckBox",
         "name":"checkBox1",
         "label":"any check box 1",
         "validators":[  
            {  
               "type":"Inclusion",
               "message":"data error"
            },
            {  
               "type":"Required",
               "message":"required error"
            }
         ]
      },
      {  
         "values":[  
            {  
               "text":"any radio item label-7",
               "value":7,
               "checked":false
            },
            {  
               "text":"any radio item label-6",
               "value":6,
               "checked":false
            },
            {  
               "text":"any radio item label-5",
               "value":5,
               "checked":false
            },
            {  
               "text":"any radio item label-4",
               "value":4,
               "checked":false
            },
            {  
               "text":"any radio item label-3",
               "value":3,
               "checked":false
            },
            {  
               "text":"any radio item label-2",
               "value":2,
               "checked":false
            },
            {  
               "text":"any radio item label-1",
               "value":1,
               "checked":false
            },
            {  
               "text":"any radio item label-0",
               "value":0,
               "checked":false
            }
         ],
         "type":"Radio",
         "name":"radio1",
         "label":"any radio",
         "validators":[  
            {  
               "type":"Inclusion",
               "message":"data error"
            },
            {  
               "type":"Required",
               "message":"required error"
            }
         ]
      },
      {  
         "values":[  
            {  
               "text":"any select item label-23",
               "value":23,
               "selected":false
            },
            {  
               "text":"any select item label-22",
               "value":22,
               "selected":false
            },
            {  
               "text":"any select item label-21",
               "value":21,
               "selected":false
            },
            {  
               "text":"any select item label-20",
               "value":20,
               "selected":false
            },
            {  
               "text":"any select item label-19",
               "value":19,
               "selected":false
            },
            {  
               "text":"any select item label-18",
               "value":18,
               "selected":false
            },
            {  
               "text":"any select item label-17",
               "value":17,
               "selected":false
            },
            {  
               "text":"any select item label-16",
               "value":16,
               "selected":false
            },
            {  
               "text":"any select item label-15",
               "value":15,
               "selected":false
            }
         ],
         "multiple":false,
         "type":"Select",
         "name":"select1",
         "label":"any select",
         "validators":[  
            {  
               "type":"Inclusion",
               "message":"data error"
            },
            {  
               "type":"Required",
               "message":"required error"
            }
         ]
      },
      {  
         "value":50,
         "min":0,
         "max":110,
         "step":1,
         "type":"Slide",
         "name":"slide1",
         "label":"slide label",
         "validators":[  
            {  
               "type":"Inclusion",
               "message":"data error"
            },
            {  
               "type":"Required",
               "message":"required error"
            }
         ]
      }
   ]
}
```
