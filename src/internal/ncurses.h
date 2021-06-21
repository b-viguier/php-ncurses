typedef unsigned chtype;
typedef unsigned mmask_t;
typedef int NCURSES_ATTR_T;
typedef short NCURSES_PAIRS_T;
typedef short NCURSES_COLOR_T;
typedef	chtype	attr_t;
typedef struct screen  SCREEN;
typedef struct _win_st WINDOW;
typedef void FILE;

extern WINDOW * stdscr;
extern int LINES;
extern int COLS;

int addch (const chtype);
int addchnstr (const chtype *, int);
int addchstr (const chtype *);
int addnstr (const char *, int);
int addstr (const char *);
int attroff (NCURSES_ATTR_T);
int attron (NCURSES_ATTR_T);
int attrset (NCURSES_ATTR_T);
int attr_get (attr_t *, NCURSES_PAIRS_T *, void *);
int attr_off (attr_t, void *);
int attr_on (attr_t, void *);
int attr_set (attr_t, NCURSES_PAIRS_T, void *);
int baudrate (void);
int beep  (void);
int bkgd (chtype);
void bkgdset (chtype);
int border (chtype,chtype,chtype,chtype,chtype,chtype,chtype,chtype);
int box (WINDOW *, chtype, chtype);
bool can_change_color (void);
int cbreak (void);
int chgat (int, attr_t, NCURSES_PAIRS_T, const void *);
int clear (void);
int clearok (WINDOW *,bool);
int clrtobot (void);
int clrtoeol (void);
int color_content (NCURSES_COLOR_T,NCURSES_COLOR_T*,NCURSES_COLOR_T*,NCURSES_COLOR_T*);
int color_set (NCURSES_PAIRS_T,void*);
int COLOR_PAIR (int);
int copywin (const WINDOW*,WINDOW*,int,int,int,int,int,int,int);
int curs_set (int);
int def_prog_mode (void);
int def_shell_mode (void);
int delay_output (int);
int delch (void);
void delscreen (SCREEN *);
int delwin (WINDOW *);
int deleteln (void);
WINDOW* derwin (WINDOW *,int,int,int,int);
int doupdate (void);
WINDOW* dupwin (WINDOW *);
int echo (void);
int echochar (const chtype);
int erase (void);
int endwin (void);
char erasechar (void);
void filter (void);
int flash (void);
int flushinp (void);
chtype getbkgd (WINDOW *);
int getch (void);
int getnstr (char *, int);
int getstr (char *);
WINDOW* getwin (FILE *);
int halfdelay (int);
bool has_colors (void);
bool has_ic (void);
bool has_il (void);
int hline (chtype, int);
void idcok (WINDOW *, bool);
int idlok (WINDOW *, bool);
void immedok (WINDOW *, bool);
chtype inch (void);
int inchnstr (chtype *, int);
int inchstr (chtype *);
WINDOW* initscr (void);
int init_color (NCURSES_COLOR_T,NCURSES_COLOR_T,NCURSES_COLOR_T,NCURSES_COLOR_T);
int init_pair (NCURSES_PAIRS_T,NCURSES_COLOR_T,NCURSES_COLOR_T);
int innstr (char *, int);
int insch (chtype);
int insdelln (int);
int insertln (void);
int insnstr (const char *, int);
int insstr (const char *);
int instr (char *);
int intrflush (WINDOW *,bool);
bool isendwin (void);
bool is_linetouched (WINDOW *,int);
bool is_wintouched (WINDOW *);
char * keyname (int);
int keypad (WINDOW *,bool);
char killchar (void);
int leaveok (WINDOW *,bool);
char* longname (void);
int meta (WINDOW *,bool);
int move (int, int);
int mvaddch (int, int, const chtype);
int mvaddchnstr (int, int, const chtype *, int);
int mvaddchstr (int, int, const chtype *);
int mvaddnstr (int, int, const char *, int);
int mvaddstr (int, int, const char *);
int mvchgat (int, int, int, attr_t, NCURSES_PAIRS_T, const void *);
int mvcur (int,int,int,int);
int mvdelch (int, int);
int mvderwin (WINDOW *, int, int);
int mvgetch (int, int);
int mvgetnstr (int, int, char *, int);
int mvgetstr (int, int, char *);
int mvhline (int, int, chtype, int);
chtype mvinch (int, int);
int mvinchnstr (int, int, chtype *, int);
int mvinchstr (int, int, chtype *);
int mvinnstr (int, int, char *, int);
int mvinsch (int, int, chtype);
int mvinsnstr (int, int, const char *, int);
int mvinsstr (int, int, const char *);
int mvinstr (int, int, char *);
int mvprintw (int,int, const char *,...);
int mvscanw (int,int, const char *,...);
int mvvline (int, int, chtype, int);
int mvwaddch (WINDOW *, int, int, const chtype);
int mvwaddchnstr (WINDOW *, int, int, const chtype *, int);
int mvwaddchstr (WINDOW *, int, int, const chtype *);
int mvwaddnstr (WINDOW *, int, int, const char *, int);
int mvwaddstr (WINDOW *, int, int, const char *);
int mvwchgat (WINDOW *, int, int, int, attr_t, NCURSES_PAIRS_T, const void *);
int mvwdelch (WINDOW *, int, int);
int mvwgetch (WINDOW *, int, int);
int mvwgetnstr (WINDOW *, int, int, char *, int);
int mvwgetstr (WINDOW *, int, int, char *);
int mvwhline (WINDOW *, int, int, chtype, int);
int mvwin (WINDOW *,int,int);
chtype mvwinch (WINDOW *, int, int);
int mvwinchnstr (WINDOW *, int, int, chtype *, int);
int mvwinchstr (WINDOW *, int, int, chtype *);
int mvwinnstr (WINDOW *, int, int, char *, int);
int mvwinsch (WINDOW *, int, int, chtype);
int mvwinsnstr (WINDOW *, int, int, const char *, int);
int mvwinsstr (WINDOW *, int, int, const char *);
int mvwinstr (WINDOW *, int, int, char *);
int mvwprintw (WINDOW*,int,int, const char *,...);
int mvwscanw (WINDOW *,int,int, const char *,...);
int mvwvline (WINDOW *,int, int, chtype, int);
int napms (int);
WINDOW * newpad (int,int);
SCREEN * newterm (const char *,FILE *,FILE *);
WINDOW * newwin (int,int,int,int);
int nl (void);
int nocbreak (void);
int nodelay (WINDOW *,bool);
int noecho (void);
int nonl (void);
void noqiflush (void);
int noraw (void);
int notimeout (WINDOW *,bool);
int overlay (const WINDOW*,WINDOW *);
int overwrite (const WINDOW*,WINDOW *);
int pair_content (NCURSES_PAIRS_T,NCURSES_COLOR_T*,NCURSES_COLOR_T*);
int PAIR_NUMBER (int);
int pechochar (WINDOW *, const chtype);
int pnoutrefresh (WINDOW*,int,int,int,int,int,int);
int prefresh (WINDOW *,int,int,int,int,int,int);
int printw (const char *,...);
int putwin (WINDOW *, FILE *);
void qiflush (void);
int raw (void);
int redrawwin (WINDOW *);
int refresh (void);
int resetty (void);
int reset_prog_mode (void);
int reset_shell_mode (void);
int ripoffline (int, int (*)(WINDOW *, int));
int savetty (void);
int scanw (const char *,...);
int scr_dump (const char *);
int scr_init (const char *);
int scrl (int);
int scroll (WINDOW *);
int scrollok (WINDOW *,bool);
int scr_restore (const char *);
int scr_set (const char *);
int setscrreg (int,int);
SCREEN * set_term (SCREEN *);
int slk_attroff (const chtype);
int slk_attr_off (const attr_t, void *);
int slk_attron (const chtype);
int slk_attr_on (attr_t,void*);
int slk_attrset (const chtype);
attr_t slk_attr (void);
int slk_attr_set (const attr_t,NCURSES_PAIRS_T,void*);
int slk_clear (void);
int slk_color (NCURSES_PAIRS_T);
int slk_init (int);
char * slk_label (int);
int slk_noutrefresh (void);
int slk_refresh (void);
int slk_restore (void);
int slk_set (int,const char *,int);
int slk_touch (void);
int standout (void);
int standend (void);
int start_color (void);
WINDOW * subpad (WINDOW *, int, int, int, int);
WINDOW * subwin (WINDOW *, int, int, int, int);
int syncok (WINDOW *, bool);
chtype termattrs (void);
char * termname (void);
void timeout (int);
int touchline (WINDOW *, int, int);
int touchwin (WINDOW *);
int typeahead (int);
int ungetch (int);
int untouchwin (WINDOW *);
void use_env (bool);
//void use_tioctl (bool);
int vidattr (chtype);
//int vidputs (chtype, NCURSES_OUTC);
int vline (chtype, int);
int vw_printw (WINDOW *, const char *,va_list);
int vw_scanw (WINDOW *, const char *,va_list);
int waddch (WINDOW *, const chtype);
int waddchnstr (WINDOW *,const chtype *,int);
int waddchstr (WINDOW *,const chtype *);
int waddnstr (WINDOW *,const char *,int);
int waddstr (WINDOW *,const char *);
int wattron (WINDOW *, int);
int wattroff (WINDOW *, int);
int wattrset (WINDOW *, int);
int wattr_get (WINDOW *, attr_t *, NCURSES_PAIRS_T *, void *);
int wattr_on (WINDOW *, attr_t, void *);
int wattr_off (WINDOW *, attr_t, void *);
int wattr_set (WINDOW *, attr_t, NCURSES_PAIRS_T, void *);
int wbkgd (WINDOW *, chtype);
void wbkgdset (WINDOW *,chtype);
int wborder (WINDOW *,chtype,chtype,chtype,chtype,chtype,chtype,chtype,chtype);
int wchgat (WINDOW *, int, attr_t, NCURSES_PAIRS_T, const void *);
int wclear (WINDOW *);
int wclrtobot (WINDOW *);
int wclrtoeol (WINDOW *);
int wcolor_set (WINDOW*,NCURSES_PAIRS_T,void*);
void wcursyncup (WINDOW *);
int wdelch (WINDOW *);
int wdeleteln (WINDOW *);
int wechochar (WINDOW *, const chtype);
int werase (WINDOW *);
int wgetch (WINDOW *);
int wgetnstr (WINDOW *,char *,int);
int wgetstr (WINDOW *, char *);
int whline (WINDOW *, chtype, int);
chtype winch (WINDOW *);
int winchnstr (WINDOW *, chtype *, int);
int winchstr (WINDOW *, chtype *);
int winnstr (WINDOW *, char *, int);
int winsch (WINDOW *, chtype);
int winsdelln (WINDOW *,int);
int winsertln (WINDOW *);
int winsnstr (WINDOW *, const char *,int);
int winsstr (WINDOW *, const char *);
int winstr (WINDOW *, char *);
int wmove (WINDOW *,int,int);
int wnoutrefresh (WINDOW *);
int wprintw (WINDOW *, const char *,...);
int wredrawln (WINDOW *,int,int);
int wrefresh (WINDOW *);
int wscanw (WINDOW *, const char *,...);
int wscrl (WINDOW *,int);
int wsetscrreg (WINDOW *,int,int);
int wstandout (WINDOW *);
int wstandend (WINDOW *);
void wsyncdown (WINDOW *);
void wsyncup (WINDOW *);
void wtimeout (WINDOW *,int);
int wtouchln (WINDOW *,int,int,int);
int wvline (WINDOW *,chtype,int);

int getattrs (const WINDOW *);
int getcurx (const WINDOW *);
int getcury (const WINDOW *);
int getbegx (const WINDOW *);
int getbegy (const WINDOW *);
int getmaxx (const WINDOW *);
int getmaxy (const WINDOW *);
int getparx (const WINDOW *);
int getpary (const WINDOW *);

typedef struct
{
    short id;		/* ID to distinguish multiple devices */
    int x, y, z;	/* event coordinates (character-cell) */
    mmask_t bstate;	/* button state bits */
} MEVENT;

mmask_t mousemask (mmask_t, mmask_t *);
int getmouse(MEVENT *);
int keypad (WINDOW *,bool);
