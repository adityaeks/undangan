<x-partner-layout>
    <x-invitation-form 
        role="partner"
        title="Buat Undangan Klien"
        :action="route('partner.invitations.store')"
        :themes="$themes"
        :clients="$clients"
        :music-presets="$musicPresets"
    />
</x-partner-layout>
