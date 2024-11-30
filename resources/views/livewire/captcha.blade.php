<div>
    <button type="button" wire:click='generateCaptcha' class="btn btn-primary btn-sm">
        Reload
    </button>
    <img src="{{ $captchaSrc }}" alt="captcha">
    <input type="hidden" name="captcha_code" value="{{ $captchaSrc }}">
</div>
