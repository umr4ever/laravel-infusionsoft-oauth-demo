
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Infusionsoft Contacts</h1>

    <table class="w-full table-auto border-collapse border border-gray-300">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-4 py-2">Name</th>
                <th class="border px-4 py-2">Email</th>
                <th class="border px-4 py-2">City</th>
                <th class="border px-4 py-2">Country</th>
                <th class="border px-4 py-2">Created</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($contacts['contacts'] as $contact)
                <tr>
                    <td class="border px-4 py-2">
                        {{ $contact['given_name'] ?? '' }} {{ $contact['family_name'] ?? '' }}
                    </td>
                    <td class="border px-4 py-2">
                        {{ $contact['email_addresses'][0]['email'] ?? 'N/A' }}
                    </td>
                    <td class="border px-4 py-2">
                        {{ $contact['addresses'][0]['locality'] ?? 'N/A' }}
                    </td>
                    <td class="border px-4 py-2">
                        {{ $contact['addresses'][0]['country_code'] ?? 'N/A' }}
                    </td>
                    <td class="border px-4 py-2">
                        {{ \Carbon\Carbon::parse($contact['date_created'])->format('M d, Y') ?? 'N/A' }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="border px-4 py-2 text-center">No contacts found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

