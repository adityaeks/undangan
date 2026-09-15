<x-partner-layout>
    <x-invitation-form 
        role="partner"
        method="PUT"
        title="Edit Undangan Klien"
        :action="route('partner.invitations.update', $invitation)"
        :invitation="$invitation"
        :themes="$themes"
        :clients="$clients"
        :music-presets="$musicPresets"
    />
</x-partner-layout>
