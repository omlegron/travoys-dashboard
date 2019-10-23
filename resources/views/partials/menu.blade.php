@foreach($items as $item)
        @if(!$item->hasChildren())
            @if(is_null($item->perms) || auth()->user()->can('read '.$item->perms))
            <li class="{{ $item->isActive ? 'active' : '' }}" >
                <a href="{!! $item->url() !!}" tabindex="{{ $item->id }}" class="{{ $item->link->class }}">
                    <i class="{{ $item->icon }} icon"></i>
                    <span>{!! $item->title !!}</span>
                </a>
            </li>
            @endif
        @else
            <li class="{{ $item->isActive ? 'active' : '' }}" >
                <a href="{!! $item->url() !!}" tabindex="{{ $item->id }}" class="{{ $item->link->class }}">
                    <span class="pull-right text-muted">
                        <i class="fa fa-fw fa-angle-right text"></i>
                        <i class="fa fa-fw fa-angle-down text-active"></i>
                    </span>
                    <i class="{{ $item->icon }} icon"></i>
                </a>
                <ul class="nav nav-sub">
                    @if($item->data['with-header'])
                        <li class="nav-sub-header">
                           <a href="#">
                               <span>{!! $item->title !!}</span>
                           </a>
                        </li>
                    @endif
                    @include('partials.menu', ['items' => $item->children()])
                </ul>
            </li>
        @endif
@endforeach