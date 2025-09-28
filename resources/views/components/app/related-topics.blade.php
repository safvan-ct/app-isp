@props(['data', 'current', 'menu_slug', 'module_slug'])
<h5 class="text-emerald fw-bold">ബന്ധപ്പെട്ട വിഷയങ്ങൾ</h5>
@foreach ($data as $item)
    @continue($current == $loop->index)

    <x-app.topic-chapter :title="$loop->index + 1 . ' : ' . $item" :url="route('answers.show', [
        'menu_slug' => $menu_slug,
        'module_slug' => $module_slug,
        'question_slug' => $loop->index,
    ])" :related="false" />
@endforeach
