**Feature**: *Multiple site support*
  As blog owners can post to a blog, except administrators,
  I want to who can post to all blogs.
  So that yes.


**Background**: 
  **Given** a global administrator named "Greg"
  **And** a blog named "Greg's anti-tax rants"
  **And** a customer named "Dr. Bill"
  **And** a blog named "Expensive Therapy" owned by "Dr. Bill"
```
-----BEGIN RSA PRIVATE KEY-----
MIICXAIBAAKBgQCqGKukO1De7zhZj6+H0qtjTkVxwTCpvKe4eCZ0FPqri0cb2JZfXJ/DgYSF6vUp
wmJG8wVQZKjeGcjDOL5UlsuusFncCzWBQ7RKNUSesmQRMSGkVb1/3j+skZ6UtW+5u09lHNsj6tQ5
1s1SPrCBkedbNf0Tp0GbMJDyR4e9T04ZZwIDAQABAoGAFijko56+qGyN8M0RVyaRAXz++xTqHBLh
3tx4VgMtrQ+WEgCjhoTwo23KMBAuJGSYnRmoBZM3lMfTKevIkAidPExvYCdm5dYq3XToLkkLv5L2
pIIVOFMDG+KESnAFV7l2c+cnzRMW0+b6f8mR1CJzZuxVLL6Q02fvLi55/mbSYxECQQDeAw6fiIQX
GukBI4eMZZt4nscy2o12KyYner3VpoeE+Np2q+Z3pvAMd/aNzQ/W9WaI+NRfcxUJrmfPwIGm63il
AkEAxCL5HQb2bQr4ByorcMWm/hEP2MZzROV73yF41hPsRC9m66KrheO9HPTJuo3/9s5p+sqGxOlF
L0NDt4SkosjgGwJAFklyR1uZ/wPJjj611cdBcztlPdqoxssQGnh85BzCj/u3WqBpE2vjvyyvyI5k
X6zk7S0ljKtt2jny2+00VsBerQJBAJGC1Mg5Oydo5NwD6BiROrPxGo2bpTbu/fhrT8ebHkTz2epl
U9VQQSQzY1oZMVX8i1m5WUTLPz2yLJIBQVdXqhMCQBGoiuSoSjafUhV7i1cEGpb88h5NBYZzWXGZ
37sJ5QsW+sJyoNde3xH8vdXhzU7eT82D6X/scw9RZz+/6rCJ4p0=
-----END RSA PRIVATE KEY-----
```



**Scenario Outline**: *eating*
  **Given** there are <start> cucumbers
  **When** I eat <eat> cucumbers
  **Then** I should have <left> cucumbers


**Examples**: 
  | start | eat | left |
  |  --- | --- | --- |
  | 12 | 5 | 7 |
  | 20 | 5 | 15 |


**Scenario**: *Dr. Bill posts to his own blog*
  **Given** I am logged in as Dr. Bill
  **When** I try to post to "Expensive Therapy"
  **Then** I should see "Your article was published."


**Scenario**: *Dr. Bill tries to post to somebody else's blog, and fails*
  **Given** I am logged in as Dr. Bill
  **When** I try to post to "Greg's anti-tax rants"
  **Then** I should see "Hey! That's not your blog!"


**Scenario**: *Greg posts to a client's blog*
  **Given** I am logged in as Greg
  **When** I try to post to "Expensive Therapy"
  **Then** I should see "Your article was published."


