@push('styles')
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
@endpush

@push('scripts')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            once: true,
            duration: 800,
        });
    </script>
@endpush

<x-layout>
    <!-- Hero Section -->
    <div class="h-[calc(100vh-4rem)] flex items-center px-6 md:px-16">
        <h1 class="font-mono text-6xl md:text-8xl font-bold max-w-4xl leading-tight">
            Let's Work
            <span class="block mt-2 text-white/60">Together</span>
        </h1>
    </div>

    <!-- Contact Info Section -->
    <div class="px-6 md:px-16 py-24 border-t border-white/20">
        <div class="grid grid-cols-12 gap-4 md:gap-8">
            <div class="col-span-12 md:col-span-4 font-mono uppercase mb-8 md:mb-0">
                Contact Info
            </div>
            <div class="col-span-12 md:col-span-8 space-y-12">
                <!-- Email -->
                <div class="group" data-aos="fade-up">
                    <div class="text-white/60 font-mono mb-2">Email</div>
                    <a href="mailto:ravi@example.com" 
                       class="text-2xl md:text-3xl font-mono hover:opacity-50 transition-opacity">
                        RaviBrugginkAdm@gmail.com
                    </a>
                </div>

                <!-- Location -->
                <div class="group" data-aos="fade-up" data-aos-delay="100">
                    <div class="text-white/60 font-mono mb-2">Location</div>
                    <div class="text-2xl md:text-3xl font-mono">Eindhoven, NL</div>
                </div>

                <!-- Socials -->
                <div class="group" data-aos="fade-up" data-aos-delay="200">
                    <div class="text-white/60 font-mono mb-2">Socials</div>
                    <div class="space-y-4">
                        <a href="#" class="block text-2xl md:text-3xl font-mono hover:opacity-50 transition-opacity">
                            LinkedIn →
                        </a>
                        <a href="#" class="block text-2xl md:text-3xl font-mono hover:opacity-50 transition-opacity">
                            GitHub →
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Availability Section -->
    <div class="px-6 md:px-16 py-24 border-t border-white/20">
        <div class="grid grid-cols-12 gap-4 md:gap-8">
            <div class="col-span-12 md:col-span-4 font-mono uppercase mb-8 md:mb-0">
                Availability
            </div>
            <div class="col-span-12 md:col-span-8">
                <div class="space-y-8" data-aos="fade-up">
                    <p class="text-xl md:text-2xl font-mono leading-relaxed">
                        Currently available for freelance projects and collaborations.
                        <span class="block mt-4 text-white/60">
                            Let's create something meaningful together.
                        </span>
                    </p>
                    <a href="mailto:ravi@example.com" 
                       class="inline-block px-8 py-4 border border-white hover:bg-white hover:text-black transition-all duration-300 font-mono uppercase text-sm tracking-wider">
                        Get in Touch
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Map Section -->
    <div class="h-[60vh] w-full relative overflow-hidden grayscale hover:grayscale-0 transition-all duration-700">
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d39813.307017823225!2d5.4534799871766905!3d51.44013082149312!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c6d90575ca5e3d%3A0x55989f5f344b006!2sEindhoven!5e0!3m2!1sen!2snl!4v1648138462489!5m2!1sen!2snl" 
            width="100%" 
            height="100%" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy"
            class="absolute inset-0">
        </iframe>
    </div>
</x-layout>