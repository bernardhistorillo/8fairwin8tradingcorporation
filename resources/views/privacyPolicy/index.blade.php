@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="background-image-cover" style="background-image:url('{{ asset('img/background/background-1.webp') }}')">
    @include('home.includes.nav')

    <div class="bg-color-2 py-5">
        <div class="container pt-4 pb-lg-4">
            <div class="container pt-4">
                <h1 class="text-center text-white">Privacy Policy</h1>
            </div>
        </div>
    </div>
</div>

<div class="bg-white py-5">
    <div class="container py-5">
        <ol>
            <li class="mb-3">
                <p class="code-pro-bold-lc text-color-2 font-size-120 mb-3">Information Collection and Use</p>

                <ol>
                    <li class="mb-3">
                        <p class="text-color-2 font-size-110 mb-0">Personal Information</p>
                        <p class="text-color-2 mb-0">When you use our login dialog and provide app details, we may collect certain personally identifiable information, including but not limited to:</p>

                        <ul>
                            <li>
                                <p class="text-color-2 mb-0">Your name</p>
                            </li>
                            <li>
                                <p class="text-color-2 mb-0">Your email address</p>
                            </li>
                            <li>
                                <p class="text-color-2 mb-0">Your profile picture (if available)</p>
                            </li>
                            <li>
                                <p class="text-color-2 mb-0">Other information you choose to provide (e.g., user preferences, app settings)</p>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <p class="text-color-2 font-size-110 mb-0">Usage Information</p>
                        <p class="text-color-2 mb-0">We may also collect non-personal information about how you interact with our login dialog and app details service. This may include:</p>

                        <ul>
                            <li>
                                <p class="text-color-2 mb-0">Your IP address</p>
                            </li>
                            <li>
                                <p class="text-color-2 mb-0">Browser type</p>
                            </li>
                            <li>
                                <p class="text-color-2 mb-0">Device type</p>
                            </li>
                            <li>
                                <p class="text-color-2 mb-0">Operating system</p>
                            </li>
                            <li>
                                <p class="text-color-2 mb-0">Date and time of access</p>
                            </li>
                            <li>
                                <p class="text-color-2 mb-0">Pages visited</p>
                            </li>
                            <li>
                                <p class="text-color-2 mb-0">Actions performed</p>
                            </li>
                        </ul>
                    </li>
                </ol>
            </li>
            <li class="mb-3">
                <p class="code-pro-bold-lc text-color-2 font-size-120 mb-3">Use of Information</p>

                <p class="text-color-2 mb-0">We may use the information we collect from you for the following purposes:</p>

                <ul>
                    <li>
                        <p class="text-color-2 mb-0">To provide and maintain our login dialog and app details service</p>
                    </li>
                    <li>
                        <p class="text-color-2 mb-0">To personalize your experience and offer tailored content</p>
                    </li>
                    <li>
                        <p class="text-color-2 mb-0">To improve our service and develop new features</p>
                    </li>
                    <li>
                        <p class="text-color-2 mb-0">To communicate with you and respond to your inquiries</p>
                    </li>
                    <li>
                        <p class="text-color-2 mb-0">To send you notifications and updates related to our service</p>
                    </li>
                    <li>
                        <p class="text-color-2 mb-0">To protect against unauthorized access or illegal activities</p>
                    </li>
                </ul>
            </li>
            <li class="mb-3">
                <p class="code-pro-bold-lc text-color-2 font-size-120 mb-3">Disclosure of Information</p>

                <p class="text-color-2 mb-0">We may disclose your personal information in the following circumstances:</p>

                <ul>
                    <li>
                        <p class="text-color-2 mb-0">To our trusted third-party service providers who assist us in operating our service</p>
                    </li>
                    <li>
                        <p class="text-color-2 mb-0">To comply with legal obligations, such as responding to a court order or governmental request</p>
                    </li>
                    <li>
                        <p class="text-color-2 mb-0">To enforce our policies and protect our rights and property</p>
                    </li>
                    <li>
                        <p class="text-color-2 mb-0">With your consent or at your direction</p>
                    </li>
                </ul>
            </li>
            <li class="mb-3">
                <p class="code-pro-bold-lc text-color-2 font-size-120 mb-3">Security</p>

                <p class="text-color-2 mb-0">We take the security of your personal information seriously and implement reasonable measures to protect it against unauthorized access, alteration, disclosure, or destruction. However, please note that no method of transmission over the internet or electronic storage is completely secure, and we cannot guarantee absolute security.</p>
            </li>
            <li class="mb-3">
                <p class="code-pro-bold-lc text-color-2 font-size-120 mb-3">Third-Party Links and Services</p>

                <p class="text-color-2 mb-0">Our login dialog and app details service may contain links to third-party websites or services. We do not control or endorse the privacy practices of these third parties. We encourage you to review the privacy policies of any third-party websites or services you visit.</p>
            </li>
            <li class="mb-3">
                <p class="code-pro-bold-lc text-color-2 font-size-120 mb-3">Children's Privacy</p>

                <p class="text-color-2 mb-0">Our service is not intended for individuals under the age of 16, and we do not knowingly collect personal information from children. If we become aware that we have collected personal information from a child without parental consent, we will take steps to delete that information.</p>
            </li>
            <li class="mb-3">
                <p class="code-pro-bold-lc text-color-2 font-size-120 mb-3">Changes to This Privacy Policy</p>

                <p class="text-color-2 mb-0">We reserve the right to update or modify this privacy policy at any time. Any changes we make will be effective immediately upon posting the revised policy on our website. We encourage you to review this policy periodically for any updates.</p>
            </li>
            <li class="mb-3">
                <p class="code-pro-bold-lc text-color-2 font-size-120 mb-3">Contact Us</p>

                <p class="text-color-2 mb-0">If you have any questions or concerns about this privacy policy or our privacy practices, please contact us at admin@8fairwin8tradingcorp.com.</p>
            </li>
        </ol>
   </div>
</div>

@include('home.includes.footer')
@endsection
