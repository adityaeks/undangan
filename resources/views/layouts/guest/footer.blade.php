<!-- GUEST FOOTER -->
<footer class="py-5 text-center text-xs text-sand-500 border-t border-sand-200/60 bg-white/40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 flex flex-col sm:flex-row items-center justify-between gap-2">
        <p>&copy; {{ date('Y') }} KlikMomen Digital Studio. All rights reserved.</p>
        <div class="flex items-center gap-4 text-[11px] text-sand-400">
            <a href="{{ url('/') }}" class="hover:text-brand-600 transition">Beranda</a>
            <span>•</span>
            <a href="{{ route('demo.index') }}" class="hover:text-brand-600 transition">Demo Undangan</a>
            <span>•</span>
            <a href="{{ url('/#partner') }}" class="hover:text-brand-600 transition">Join Partner (WO)</a>
        </div>
    </div>
</footer>
