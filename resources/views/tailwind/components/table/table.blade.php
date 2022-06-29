<div class="align-middle min-w-full overflow-x-auto shadow overflow-hidden rounded-none md:rounded-lg mb-6">
    <table class="{{ trim($attributes->get('class')) ?: 'min-w-full divide-y divide-gray-200 dark:divide-none'}}">
        <thead>
        <tr>
            {{ $head }}
        </tr>
        </thead>

        <tbody class="bg-white divide-y divide-gray-200 dark:divide-none">
        {{ $body }}
        </tbody>
    </table>
</div>
