<!-- MEMBER FOOTER -->
<footer class="py-5 px-6 sm:px-8 border-t border-sand-200/80 bg-white/50 text-xs text-sand-500 flex flex-col sm:flex-row items-center justify-between gap-2">
    <div class="flex items-center gap-2">
        <span class="w-2 h-2 rounded-full bg-brand-500"></span>
        <span>KlikMomen Portal Pengantin • Seluruh Fitur Undangan Aktif</span>
    </div>
    <div class="flex items-center gap-4 text-[11px]">
        <a href="{{ route('demo.index') }}" target="_blank" class="hover:text-brand-700 transition">Preview Undangan</a>
        <span>•</span>
        <a href="https://wa.me/?text=Halo%20Admin%20KlikMomen" target="_blank" class="hover:text-brand-700 transition">Hubungi Bantuan</a>
        <span>•</span>
        <p>&copy; {{ date('Y') }} KlikMomen. Hak Cipta Dilindungi.</p>
    </div>
</footer>
