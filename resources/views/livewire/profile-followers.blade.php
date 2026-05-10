
<div>
    <link rel="stylesheet" href="{{ asset('css/profile/followers.css') }}">

    <div class="followers-header">
        <a href="{{ route('profile.show', $user) }}" class="btn-back">← Назад к профилю</a>
    </div>

    <div class="followers-tabs">
        <button class="tab {{ $tab === 'followers' ? 'active' : '' }}" wire:click="$set('tab', 'followers')">
            Подписчики <span class="tab-count">{{ $followers->count() }}</span>
        </button>
        <button class="tab {{ $tab === 'following' ? 'active' : '' }}" wire:click="$set('tab', 'following')">
            Подписки <span class="tab-count">{{ $following->count() }}</span>
        </button>
    </div>

    <div class="followers-list">
        @if($tab === 'followers')
            @forelse($followers as $follower)
                <div class="follower-card">
                    <a href="{{ route('profile.show', $follower) }}" class="follower-link">
                        <div class="follower-avatar">
                            @if($follower->avatar)
                                <img src="{{ asset('storage/' . $follower->avatar) }}" alt="{{ $follower->name }}">
                            @else
                                <span class="follower-avatar-letter">{{ strtoupper(substr($follower->name, 0, 1)) }}</span>
                            @endif
                        </div>
                        <span class="follower-name">{{ $follower->name }}</span>
                    </a>

                    @if(auth()->id() === $user->id)
                        <button wire:click="removeFollower({{ $follower->id }})" class="btn-remove">
                            Удалить
                        </button>
                    @endif
                </div>
            @empty
                <div class="empty-state">
                    <div class="empty-icon">👤</div>
                    <p>Нет подписчиков</p>
                </div>
            @endforelse
        @endif

        @if($tab === 'following')
            @forelse($following as $followed)
                <div class="follower-card">
                    <a href="{{ route('profile.show', $followed) }}" class="follower-link">
                        <div class="follower-avatar">
                            @if($followed->avatar)
                                <img src="{{ asset('storage/' . $followed->avatar) }}" alt="{{ $followed->name }}">
                            @else
                                <span class="follower-avatar-letter">{{ strtoupper(substr($followed->name, 0, 1)) }}</span>
                            @endif
                        </div>
                        <span class="follower-name">{{ $followed->name }}</span>
                    </a>

                    @if(auth()->id() === $user->id)
                        <button wire:click="unfollow({{ $followed->id }})" class="btn-remove">
                            Отписаться
                        </button>
                    @endif
                </div>
            @empty
                <div class="empty-state">
                    <div class="empty-icon">👤</div>
                    <p>Нет подписок</p>
                </div>
            @endforelse
        @endif
    </div>
</div>