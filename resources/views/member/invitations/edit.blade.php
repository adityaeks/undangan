<x-member-layout>
    <x-invitation-form 
        role="member"
        :action="route('member.invitations.update', $invitation)"
        method="PUT"
        :invitation="$invitation"
        :themes="$themes"
        :music-presets="$musicPresets"
        :used-theme-ids="$usedThemeIds ?? []"
    />
</x-member-layout>
