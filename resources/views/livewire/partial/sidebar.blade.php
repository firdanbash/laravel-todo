<aside
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-14 transition-transform -translate-x-full bg-white border-r border-gray-200 md:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
    aria-label="Sidenav" id="drawer-navigation">

    <!-- User Profile Section -->
    <div class="p-4 border-b border-gray-200 dark:border-gray-700">
        <div class="flex items-center space-x-3">
            <div class="flex-shrink-0">
                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                    <span class="text-white font-semibold text-sm">
                        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                    </span>
                </div>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                    {{ auth()->user()->name }}
                </p>
                <p class="text-xs text-gray-500 truncate dark:text-gray-400">
                    {{ auth()->user()->email }}
                </p>
            </div>
        </div>
    </div>

    <div class="overflow-y-auto py-5 px-3 h-full bg-white dark:bg-gray-800">
        <!-- Main Navigation -->
        <ul class="space-y-1">
            <!-- Dashboard/Home -->
            <li>
                <a href="/todo"
                    class="flex items-center p-3 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group transition-all duration-200 {{ request()->is('todo') ? 'bg-blue-50 dark:bg-blue-900/20 border-r-2 border-blue-500' : '' }}">
                    <svg aria-hidden="true"
                        class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white {{ request()->is('todo') ? 'text-blue-500' : '' }}"
                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                        <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                    </svg>
                    <span class="ml-3">Dashboard</span>
                </a>
            </li>

            <!-- Todo Section with Collapse -->
            <li>
                <button type="button"
                    class="flex items-center p-3 w-full text-base font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ request()->is('todo') ? 'bg-blue-50 dark:bg-blue-900/20 border-r-2 border-blue-500' : '' }}"
                    aria-controls="dropdown-todo" data-collapse-toggle="dropdown-todo">
                    <svg aria-hidden="true"
                        class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white {{ request()->is('todo') ? 'text-blue-500' : '' }}"
                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="flex-1 ml-3 text-left whitespace-nowrap">My Tasks</span>
                    <span class="inline-flex items-center justify-center px-2 ml-3 text-sm font-medium text-gray-800 bg-gray-200 rounded-full dark:bg-gray-700 dark:text-gray-300">
                        {{ $this->getTodoCount() }}
                    </span>
                    <svg aria-hidden="true" class="w-4 h-4 transition-transform" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
                <ul id="dropdown-todo" class="hidden py-2 space-y-1">
                    <li>
                        <a href="/todo"
                            class="flex items-center p-2 pl-11 w-full text-sm font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ request()->is('todo') && !request('filter') ? 'text-blue-600 dark:text-blue-400' : '' }}">
                            <span class="flex-1 whitespace-nowrap">All Tasks</span>
                            <span class="inline-flex justify-center items-center w-5 h-5 text-xs font-semibold rounded-full text-primary-800 bg-primary-100 dark:bg-primary-200 dark:text-primary-800">
                                {{ $this->getTodoCount() }}
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="/todo?filter=pending"
                            class="flex items-center p-2 pl-11 w-full text-sm font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ request('filter') == 'pending' ? 'text-blue-600 dark:text-blue-400' : '' }}">
                            <span class="flex-1 whitespace-nowrap">Pending</span>
                            <span class="inline-flex justify-center items-center w-5 h-5 text-xs font-semibold rounded-full text-yellow-800 bg-yellow-100 dark:bg-yellow-200 dark:text-yellow-800">
                                {{ $this->getPendingCount() }}
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="/todo?filter=completed"
                            class="flex items-center p-2 pl-11 w-full text-sm font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ request('filter') == 'completed' ? 'text-blue-600 dark:text-blue-400' : '' }}">
                            <span class="flex-1 whitespace-nowrap">Completed</span>
                            <span class="inline-flex justify-center items-center w-5 h-5 text-xs font-semibold rounded-full text-green-800 bg-green-100 dark:bg-green-200 dark:text-green-800">
                                {{ $this->getCompletedCount() }}
                            </span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Quick Stats -->
            <li>
                <div class="p-3 text-sm text-gray-500 dark:text-gray-400">
                    <div class="grid grid-cols-2 gap-2">
                        <div class="text-center p-2 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                            <div class="text-lg font-bold text-blue-600 dark:text-blue-400">{{ $this->getPendingCount() }}</div>
                            <div class="text-xs">Pending</div>
                        </div>
                        <div class="text-center p-2 bg-green-50 dark:bg-green-900/20 rounded-lg">
                            <div class="text-lg font-bold text-green-600 dark:text-green-400">{{ $this->getCompletedCount() }}</div>
                            <div class="text-xs">Done</div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>

        <!-- Bottom Section -->
        <ul class="pt-5 mt-5 space-y-1 border-t border-gray-200 dark:border-gray-700">
            <!-- Settings (Placeholder) -->
            <li>
                <a href="#"
                    class="flex items-center p-3 text-base font-medium text-gray-900 rounded-lg transition duration-75 hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-white group">
                    <svg aria-hidden="true"
                        class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="ml-3">Settings</span>
                </a>
            </li>

            <!-- Help (Placeholder) -->
            <li>
                <a href="#"
                    class="flex items-center p-3 text-base font-medium text-gray-900 rounded-lg transition duration-75 hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-white group">
                    <svg aria-hidden="true"
                        class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-2 0c0 .993-.241 1.929-.668 2.754l-1.524-1.525a3.997 3.997 0 00.078-2.183l1.562-1.562C15.802 8.249 16 9.1 16 10zm-5.165 3.913l1.58 1.58A5.98 5.98 0 0110 16a5.976 5.976 0 01-2.516-.552l1.562-1.562a4.006 4.006 0 001.789.027zm-4.677-2.796a4.002 4.002 0 01-.041-2.08l-.08.08-1.53-1.533A5.98 5.98 0 004 10c0 .954.223 1.856.619 2.657l1.54-1.54zm1.088-6.45A5.974 5.974 0 0110 4c.954 0 1.856.223 2.657.619l-1.54 1.54a4.002 4.002 0 00-2.346.033L7.246 4.668zM12 10a2 2 0 11-4 0 2 2 0 014 0z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="ml-3">Help & Support</span>
                </a>
            </li>

            <!-- Logout -->
            <li>
                <button wire:click="logout"
                    class="flex items-center p-3 w-full text-base font-medium text-gray-900 rounded-lg transition duration-75 hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-white group">
                    <svg aria-hidden="true"
                        class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="ml-3">Logout</span>
                </button>
            </li>
        </ul>
    </div>
</aside>
