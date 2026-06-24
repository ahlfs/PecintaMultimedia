<div class="comments-section-wrapper">

    {{-- ===== FORM TAMBAH KOMENTAR ===== --}}
    @if(session()->has('user_id'))
        <form wire:submit.prevent="addComment" class="comment-form mb-5">
            <div class="comment-input-row">
                {{-- Avatar user yang login --}}
                @php $currentUser = \App\Models\User::find(session('user_id')); @endphp
                <img
                    src="{{ $currentUser && $currentUser->profile_photo ? asset($currentUser->profile_photo) : 'https://ui-avatars.com/api/?name='.urlencode($currentUser->name ?? 'U').'&background=293681&color=fff&bold=true' }}"
                    alt="Avatar"
                    class="comment-avatar-sm"
                >
                <div class="comment-input-wrap">
                    <textarea
                        wire:model="newComment"
                        id="new-comment-input"
                        placeholder="Tulis komentar kamu..."
                        rows="2"
                        class="comment-textarea"
                        maxlength="1000"
                    ></textarea>
                    @error('newComment')
                        <span class="comment-error-msg">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="comment-form-actions">
                <span class="comment-char-hint">Maks. 1000 karakter</span>
                <button type="submit" class="comment-submit-btn" id="btn-submit-comment">
                    <i class="fa-solid fa-paper-plane mr-1.5"></i> Kirim
                </button>
            </div>
        </form>
    @else
        <div class="comment-login-prompt">
            <i class="fa-regular fa-comment-dots text-2xl mb-2 block text-slate-300"></i>
            <p class="text-xs text-slate-500">
                <a href="{{ route('login') }}" class="text-brand-accent font-bold hover:underline">Masuk</a>
                untuk meninggalkan komentar.
            </p>
        </div>
    @endif

    {{-- ===== DAFTAR KOMENTAR ===== --}}
    <div class="comments-list" id="comments-list">
        @forelse($comments as $comment)
            <div class="comment-item" wire:key="comment-{{ $comment->id }}">
                {{-- Avatar --}}
                <img
                    src="{{ $comment->user->profile_photo ? asset($comment->user->profile_photo) : 'https://ui-avatars.com/api/?name='.urlencode($comment->user->name).'&background=293681&color=fff&bold=true' }}"
                    alt="{{ $comment->user->name }}"
                    class="comment-avatar-sm mt-0.5"
                >
                {{-- Bubble --}}
                <div class="comment-bubble-wrap">
                    <div class="comment-bubble">
                        <div class="comment-bubble-header">
                            <a href="{{ route('profile.show', $comment->user->id) }}" class="comment-author">
                                {{ $comment->user->name }}
                            </a>
                            <span class="comment-time">{{ $comment->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="comment-body">{{ $comment->body }}</p>
                    </div>
                    {{-- Tombol hapus (pemilik komentar atau pemilik post) --}}
                    @if(session('user_id') === $comment->user_id || session('user_id') === $post->user_id)
                        <button
                            wire:click="deleteComment({{ $comment->id }})"
                            wire:confirm="Hapus komentar ini?"
                            class="comment-delete-btn"
                            title="Hapus komentar"
                        >
                            <i class="fa-solid fa-trash-can text-xs"></i>
                        </button>
                    @endif
                </div>
            </div>
        @empty
            <div class="comment-empty-state" id="comment-empty-state">
                <i class="fa-regular fa-comments text-3xl mb-2 text-slate-300 block"></i>
                <p class="text-xs text-slate-400">Belum ada komentar. Jadilah yang pertama!</p>
            </div>
        @endforelse
    </div>

</div>
