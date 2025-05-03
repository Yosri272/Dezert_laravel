@component('mail::message')
<table width="100%" style="text-align: center;">
    <tr>
        <td>
            <img src="{{ asset('img/logo.png') }}" style="width: 200px;">
        </td>
    </tr>
</table>

# مرحباً {{ $user->name }}

شكراً لتسجيلك في موقعنا. نحن سعداء بانضمامك إلى **شركة صحراء الابتكار للتقنية**.

---

# Hello {{ $user->name }}

Thank you for registering on our website. We are delighted to have you join **Dezert Innovate Technology Company**.

@component('mail::button', ['url' => config('app.url')])
زيارة الموقع - Visit Website
@endcomponent

---

Thanks & Regards,  
**Atif Khan**  
Sr. Software Development Manager  
Engineering Department  
**Dezert Innovate Technology Company (شركة صحراء الابتكار للتقنية)**  

📞 +966 539188161  
📧 sdm@dezert.sa  
🌐 [www.dezert.sa](http://www.dezert.sa)  
📍 Sari Branch Road, Jeddah, Saudi Arabia  
@endcomponent
