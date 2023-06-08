@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="background-image-cover" style="background-image:url('{{ asset('img/background/background-1.webp') }}')">
    @include('home.includes.nav')

    <div class="bg-color-2 py-5">
        <div class="container pt-4 pb-lg-4">
            <div class="container pt-4">
                <h1 class="text-center text-white">Terms of Service</h1>
            </div>
        </div>
    </div>
</div>

<div class="bg-white py-5">
    <div class="container py-5">
        <p class="text-color-2 mb-4">These Terms of Service ("Terms") govern your use of the login dialog and app details service provided by 8fairwin8 Trading Corporation ("we," "us," or "our"). By accessing or using our service, you agree to be bound by these Terms. If you do not agree with any part of these Terms, please do not use our service.</p>

        <ol>
            <li class="mb-3">
                <p class="code-pro-bold-lc text-color-2 font-size-120 mb-3">Use of Service</p>

                <ol>
                    <li class="mb-3">
                        <p class="text-color-2 font-size-110 mb-0">Eligibility</p>
                        <p class="text-color-2 mb-0">You must be at least 16 years old to use our service. By using our service, you represent and warrant that you are of legal age to enter into these Terms and comply with all applicable laws and regulations.</p>
                    </li>

                    <li class="mb-3">
                        <p class="text-color-2 font-size-110 mb-0">Account Registration</p>
                        <p class="text-color-2 mb-0">To access certain features of our service, you may need to create an account. You agree to provide accurate, complete, and up-to-date information during the registration process and to keep your account information updated. You are responsible for maintaining the confidentiality of your account credentials and for all activities that occur under your account.</p>
                    </li>

                    <li class="mb-3">
                        <p class="text-color-2 font-size-110 mb-0">Prohibited Activities</p>
                        <p class="text-color-2 mb-0">You agree not to engage in any of the following prohibited activities:</p>

                        <ul>
                            <li>
                                <p class="text-color-2 mb-0">Violating any applicable laws or regulations</p>
                            </li>
                            <li>
                                <p class="text-color-2 mb-0">Interfering with or disrupting the integrity or performance of our service</p>
                            </li>
                            <li>
                                <p class="text-color-2 mb-0">Attempting to gain unauthorized access to our service or its related systems or networks</p>
                            </li>
                            <li>
                                <p class="text-color-2 mb-0">Impersonating another person or entity</p>
                            </li>
                            <li>
                                <p class="text-color-2 mb-0">Collecting or harvesting any information from our service without proper authorization</p>
                            </li>
                            <li>
                                <p class="text-color-2 mb-0">Engaging in any activity that could adversely affect our service or its users</p>
                            </li>
                        </ul>
                    </li>
                </ol>
            </li>
            <li class="mb-3">
                <p class="code-pro-bold-lc text-color-2 font-size-120 mb-3">Intellectual Property Rights</p>

                <p class="text-color-2 mb-0">Our service, including but not limited to the login dialog, app details, and all associated content, is protected by intellectual property laws. You acknowledge and agree that we own all right, title, and interest in and to our service and its content, including any intellectual property rights therein. You are granted a limited, non-exclusive, non-transferable, and revocable license to use our service solely for its intended purposes.</p>
            </li>
            <li class="mb-3">
                <p class="code-pro-bold-lc text-color-2 font-size-120 mb-3">Disclaimer of Warranties</p>

                <p class="text-color-2 mb-0">Our service is provided on an "as is" and "as available" basis, without warranties of any kind, either express or implied. We do not warrant that our service will be uninterrupted, error-free, or free of viruses or other harmful components. You use our service at your own risk.</p>
            </li>
            <li class="mb-3">
                <p class="code-pro-bold-lc text-color-2 font-size-120 mb-3">Limitation of Liability</p>

                <p class="text-color-2 mb-0">To the maximum extent permitted by applicable law, we shall not be liable for any indirect, incidental, special, consequential, or punitive damages, including but not limited to loss of profits, data, or goodwill, arising from your use of or inability to use our service, even if we have been advised of the possibility of such damages.</p>
            </li>
            <li class="mb-3">
                <p class="code-pro-bold-lc text-color-2 font-size-120 mb-3">Indemnification</p>

                <p class="text-color-2 mb-0">You agree to indemnify and hold us harmless from and against any claims, liabilities, damages, losses, and expenses, including reasonable attorneys' fees, arising out of or in connection with your use of our service or any violation of these Terms.</p>
            </li>
            <li class="mb-3">
                <p class="code-pro-bold-lc text-color-2 font-size-120 mb-3">Governing Law and Jurisdiction</p>

                <p class="text-color-2 mb-0">These Terms shall be governed by and construed in accordance with the laws of the Republic of the Philippines. Any legal action or proceeding arising out of or relating to these Terms shall be exclusively brought in the courts of [Your Jurisdiction], and you consent to the jurisdiction of such courts.</p>
            </li>
            <li class="mb-3">
                <p class="code-pro-bold-lc text-color-2 font-size-120 mb-3">Modifications to the Terms</p>

                <p class="text-color-2 mb-0">We reserve the right to modify or update these Terms at any time. Any changes will be effective immediately upon posting the updated Terms on our website. It is your responsibility to review these Terms periodically for any updates. By continuing to use our service after any modifications to the Terms, you agree to be bound by the revised Terms.</p>
            </li>
            <li class="mb-3">
                <p class="code-pro-bold-lc text-color-2 font-size-120 mb-3">Severability</p>

                <p class="text-color-2 mb-0">If any provision of these Terms is held to be invalid, illegal, or unenforceable, the remaining provisions shall continue in full</p>
            </li>
        </ol>
   </div>
</div>

@include('home.includes.footer')
@endsection
