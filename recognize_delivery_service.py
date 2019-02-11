#	@author SanGreel (Andrew Kurochkin), Lviv
#	@official site https://andrewkurochkin.com
#	@copyright 2018
# 	coding: utf-8


import re

def recognize_delivery_service(tracking):
    service = None
   
    usps_pattern = [
        '^(94|93|92|94|95)[0-9]{20}$',
        '^(94|93|92|94|95)[0-9]{22}$',
        '^(70|14|23|03)[0-9]{14}$',
        '^(M0|82)[0-9]{8}$',
        '^([A-Z]{2})[0-9]{9}([A-Z]{2})$'
    ]

    ups_pattern = [
        '^(1Z)[0-9A-Z]{16}$',
        '^(T)+[0-9A-Z]{10}$',
        '^[0-9]{9}$',
        '^[0-9]{26}$'
    ]
    
    fedex_pattern = [
        '^[0-9]{20}$',
        '^[0-9]{15}$',
        '^[0-9]{12}$',
        '^[0-9]{22}$'
    ]
    
    usps = "(" + ")|(".join(usps_pattern) + ")"
    fedex = "(" + ")|(".join(fedex_pattern) + ")"
    ups= "(" + ")|(".join(ups_pattern) + ")"
    
    if re.match(usps, tracking) != None:
        service = 'USPS'
    elif re.match(ups, tracking) != None:
        service = 'UPS'
    elif re.match(fedex, tracking) != None:
        service = 'FedEx'

    return service

