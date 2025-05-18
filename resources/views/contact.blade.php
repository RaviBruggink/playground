<x-layout>
    <div class="min-h-screen px-6 md:px-16 flex flex-col justify-center">
        <!-- Contact Info -->
        <div class="grid grid-cols-12 gap-4 border-t border-b border-white/20 py-8">
            <div class="col-span-4 font-mono uppercase">
                Contact Info
            </div>
            <div class="col-span-8 space-y-4">
                <div class="font-mono">
                    <span class="text-white/60">Email:</span>
                    <a href="mailto:ravi@example.com" class="ml-4 hover:opacity-50 transition-opacity">ravi@example.com</a>
                </div>
                <div class="font-mono">
                    <span class="text-white/60">Location:</span>
                    <span class="ml-4">Amsterdam, NL</span>
                </div>
                <div class="font-mono">
                    <span class="text-white/60">Socials:</span>
                    <a href="#" class="ml-4 hover:opacity-50 transition-opacity">LinkedIn</a>
                    <a href="#" class="ml-4 hover:opacity-50 transition-opacity">GitHub</a>
                    <a href="#" class="ml-4 hover:opacity-50 transition-opacity">Twitter</a>
                </div>
            </div>
        </div>

        <!-- Japanese Text -->
        <div class="fixed bottom-8 left-8 text-5xl font-bold opacity-10 select-none pointer-events-none">
            コンタクト
        </div>
    </div>
</x-layout>