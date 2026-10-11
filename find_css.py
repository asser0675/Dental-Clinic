with open('public/assets/css/app.css', 'r', encoding='utf-8') as f:
    app_css = f.read()

with open('public/assets/css/clinic-fixes.css', 'r', encoding='utf-8') as f:
    fixes_css = f.read()

for name, css in [('app.css', app_css), ('clinic-fixes.css', fixes_css)]:
    lines = css.splitlines()
    for idx, line in enumerate(lines):
        if any(w in line for w in ['dialog[open]', 'dialog:not([open])', '.modal:not([open])', 'display: none', 'display: block', 'dialog.modal', '.modal-shell', 'z-index']):
            if 'dialog' in line or 'modal' in line:
                print(f'{name}:{idx+1} -> {line[:120]}')

