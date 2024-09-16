<!DOCTYPE html>
<html lang="en">
    @include('frontend.layout.head')
    <body>
        @include('frontend.layout.header')
        @include('frontend.layout.hero_section')
        <main id="main">
            @include('frontend.layout.about')
            @include('frontend.layout.services')
            @include('frontend.layout.counter')
            @include('frontend.layout.projects')
            @include('frontend.layout.Portfolio')
            @include('frontend.layout.Testimonials')
            @include('frontend.layout.Blog')
            @include('frontend.layout.Contact')
        </main>
        @include('frontend.layout.footer')
    </body>
</html>
