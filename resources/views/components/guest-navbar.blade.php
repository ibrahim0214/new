<div class="fixed px-3 navbar text-white" style="z-index: 10; background:linear-gradient(135deg, #172a74, #21a9af);">
    <div class="navbar-start">

      <a class="btn btn-ghost text-xl">OSCE STIKES NOTOKUSUMO</a>
    </div>

    <div class="navbar-end">
        <div class="dropdown dropdown-end">
            <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
              <div class="w-10 border-2 border-white rounded-full">
                <img
                  alt="User Images"
                  src="{{ asset('asset/images/user/user2.png') }}" />
              </div>
            </div>
            <ul
                tabindex="0"
                class="menu menu-sm dropdown-content bg-base-100 text-black dark:text-white rounded-box z-[1] mt-3 w-52 p-2 shadow">
                <div class="px-3 mb-2">
                    <span>Welcome,</span>
                    <span class="font-semibold">Guest</span>
                </div>
                <hr>
                <li><a wire:navigate href="{{ route('login') }}">Login</a></li>
            </ul>
        </div>
    </div>
</div>
